<?php

class MessagesModel extends CI_Model {

    public function insert($fields, $values)
    {
        DB::insert("messages")
            ->parametters($fields)
            ->execute($values);
    }
    public function findBy(array $data)
    {
        $condition = "";
        $i = 0;
        foreach($data as $k => $v)
        {
            if($i===0)
            {
                $condition .= $k."=:".$k;
            }
            else
            {
                $condition .= " AND ".$k."=:".$k;
            }
            $i++;
        }

        return DB::customQuery("SELECT * FROM messages WHERE {$condition} ORDER BY id ASC",$data);
    }
    
    public function findLastBy(array $data)
    {
        $condition = "";
        $i = 0;
        foreach($data as $k => $v)
        {
            if($i===0)
            {
                $condition .= $k."=:".$k;
            }
            else
            {
                $condition .= " AND ".$k."=:".$k;
            }
            $i++;
        }

        return DB::customQuery("SELECT * FROM messages WHERE {$condition} ORDER BY id DESC LIMIT 1",$data,false);
    }
    public function findLast()
    {
        return DB::customQuery("SELECT * FROM messages ORDER BY id DESC LIMIT 1", [],false);
    }
    
    public function unreadCountBy(array $data)
    {
        $condition = "";
        $i = 0;
        foreach($data as $k => $v)
        {
            if($i===0)
            {
                $condition .= $k."=:".$k;
            }
            else
            {
                $condition .= " AND ".$k."=:".$k;
            }
            $i++;
        }

        $res = DB::customQuery("SELECT DISTINCT id_service FROM messages WHERE {$condition}",$data);
        $count = count($res);
        if(array_key_exists('read_by_user', $data))
        {
            $messagesByAdmin = DB::customQuery("SELECT massages.*
                                INNER JOIN service_client AS sc ON sc.id=messages.id_service  
                                FROM messages 
                                AND sc.start_by_admin=1");
            foreach($messagesByAdmin as $message)
            {
                $usersReadId = json_decode($message->read_by_user);
                if(!in_array($data['id_user'], $usersReadId))
                {
                    $count++;
                }
            }
        }
        
        return $count;
    }

    public function markAsReadByAdmin($idService)
    {
        DB::update("messages")
            ->parametters(["read_by_admin"])
            ->where("id_service","=")
            ->execute([1, $idService]);
    }
    public function markAsReadByUser($idService, $idUser)
    {
        $service = DB::select('service_client')->where('id', '=')->fetchOne([$idService]);
        if((int)$service->start_by_admin === 0) 
        {
            DB::update("messages")
                ->parametters(["read_by_user"])
                ->where("id_service","=")
                ->execute([1, $idService]);
        }
        else
        {
            $messages = DB::customQuery("SELECT * FROM messages WHERE id_service=:idService AND sender=:sender", ['idService' => $idService, "sender" => "admin"]);
            foreach($messages as $message)
            {
                $usersReadId = json_decode($message->read_by_user);
                if(!in_array($idUser, $usersReadId))
                {
                    $usersReadId[] = $idUser;
                    DB::update("messages")
                        ->parametters(["read_by_user"])
                        ->where("id_service","=")
                        ->execute([json_encode($usersReadId), $idService]);
                }
            }
        }
        
    }

    public function getCountByUser($idUser)
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages WHERE id_user=?",[$idUser], false);
        return (int)$res->count;
    }
    public function getCountByAdmin()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages",[], false);
        return (int)$res->count;
    }

    public function findStartByAdmin($idService)
    {
        return DB::customQuery("SELECT messages.*
                    FROM messages 
                    INNER JOIN service_client AS sc ON sc.id=messages.id_service  
                    WHERE messages.id_service=:idService 
                    AND sc.start_by_admin=1", 
                    ['idService' => $idService]
                );
    }
    public function listStartByAdmin($idService)
    {
        return DB::customQuery("SELECT messages.*, u.id AS client_id, u.pseudo, u.photo
                    FROM messages 
                    LEFT JOIN user AS u ON u.id=messages.id_user 
                    WHERE messages.id_service=:idService", 
                    ['idService' => $idService]
                );
    }
}