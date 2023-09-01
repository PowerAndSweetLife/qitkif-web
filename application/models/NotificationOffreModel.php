<?php

class NotificationOffreModel extends CI_Model {

    public function insert($fields,$values)
    {
        DB::insert("notification_offre")
            ->parametters($fields)
            ->execute($values);
        $last = DB::customQuery("SELECT MAX(id) AS id FROM notification_offre LIMIT 1",[],false);
        return $last->id;
    }
    public function update($fields,$values)
    {
        DB::update("notification_offre")
            ->parametters($fields)
            ->where("id","=")
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

        return DB::customQuery("SELECT notification_offre.*,historique_offre.montant,historique_offre.etat,historique_offre.message AS msg
            FROM notification_offre 
            INNER JOIN historique_offre ON historique_offre.id_notification_offre=notification_offre.id
            WHERE {$condition}
            ORDER BY notification_offre.created_at DESC",$data
        );
    }
    public function findOneDeviceBy(array $data)
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

        return DB::customQuery("SELECT * FROM user_device
            WHERE {$condition}",$data,false
        );
    }

    public function registerDevice($fields,$values)
    {
        DB::insert("user_device")
            ->parametters($fields)
            ->execute($values);
    }

    public function getDevicesUser($idUser)
    {
        return DB::select("user_device")
            ->where("id_user","=")
            ->execute([$idUser]);
    }

    public function getCountUnread($idUser)
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM notification_offre WHERE id_user=? AND is_read=?",[$idUser,0],false);
        return (int)$res->count;
    }
    public function getLastByOffre($idUser, $idOffre)
    {
        return DB::customQuery("SELECT * FROM notification_offre WHERE id_user=? AND id_offre=? ORDER BY id DESC LIMIT 1", [$idUser, $idOffre], false);
    }
}