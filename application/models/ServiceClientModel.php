<?php

class ServiceClientModel extends CI_Model {

    public function findAllByUser($idUser)
    {
        // $data = DB::select('service_client')
        //         ->where("id_user","=")
        //         ->order(['created_at' => 'DESC'])
        //         ->execute([$idUser]);
        $data = DB::customQuery("SELECT * FROM service_client WHERE id_user=:user OR id_vendeur=:user OR start_by_admin=1 ORDER BY created_at DESC", [
            "user" => $idUser
        ]);
        foreach($data as $k => $v)
        {
            if($v->type === 'litige')
            {
                $data[$k]->offre = DB::select("offre")->where("id","=")->fetchOne([$v->id_offre]);
                $data[$k]->acheteur = DB::select("user")->where("id", "=")->fetchOne([$v->id_user]);
                $data[$k]->vendeur = DB::select("user")->where("id", "=")->fetchOne([$v->id_vendeur]);
                $data[$k]->ref = 'Réf_' . str_pad($v->id, 5, "0", STR_PAD_LEFT);
            }
        }
        return $data; 
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

        return DB::customQuery("SELECT * FROM service_client WHERE {$condition}",$data);
    }

    public function findOneBy(array $data)
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

        return DB::customQuery("SELECT * FROM service_client WHERE {$condition}",$data,false);
    }

    public function generateNumero($type)
    {
        $res = DB::customQuery("SELECT * FROM service_client WHERE `type`=? ORDER BY id DESC LIMIT 1",[$type],false);
        if($res)
        {
            $newNum = (int)$res->numero + 1;
            return str_pad($newNum, 5, "0", STR_PAD_LEFT);
        }
        return '00001';
    }

    public function insert($fields,$values)
    {
        DB::insert("service_client")
            ->parametters($fields)
            ->execute($values);
        $res = DB::customQuery("SELECT MAX(id) AS id FROM service_client LIMIT 1",[],false);
        return (int)$res->id;
    }

    public function update($fields, $values)
    {
        DB::update('service_client')
            ->parametters($fields)
            ->where('id','=')
            ->execute($values);
    }
}