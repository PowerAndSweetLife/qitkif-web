<?php

class UserModel extends CI_Model {
    const LIMIT = 20;
    public function findOneBy(array $data, int $finished=1)
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

        $condition .= " AND is_finished=$finished";

        return DB::customQuery("SELECT * FROM user WHERE {$condition}",$data, false);
    }

    public function getLastInserted()
    {
        return DB::customQuery("SELECT * FROM user ORDER BY id DESC LIMIT 1",[],false);
    }

    public function findOneNofinished($id)
    {
        return DB::customQuery("SELECT * FROM user WHERE id=?",[$id],false);
    }

    public function findOneNofinishedByPhone($phone)
    {
        return DB::customQuery("SELECT * FROM user WHERE phone=?",[$phone],false);
    }

    public function search($query,$offset=0)
    {
        return DB::customQuery("SELECT * FROM user 
            WHERE id != ? AND is_finished=? AND
            (pseudo LIKE ? 
            OR phone LIKE ? 
            OR email LIKE ?)
            ORDER BY id ASC 
            LIMIT " . self::LIMIT . 
            " OFFSET " . $offset ,
            [$this->session->userdata('userId'),1,$query,$query,$query]
        );
    }

    public function getCount()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM user",[],false);
        return (int)$res->count;
    }
    public function insert($fields,$values)
    {
        DB::insert("user")
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update("user")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }

    public function paginate($offset=0)
    {
        return DB::customQuery("SELECT * FROM user
            LIMIT " . self::LIMIT . 
            " OFFSET " . $offset 
        );
    }
    public function filterAll($query)
    {
        return DB::customQuery("SELECT * FROM user
            WHERE pseudo LIKE ? 
            OR phone LIKE ? 
            OR email LIKE ?
            LIMIT " . self::LIMIT,
            [$query,$query,$query] 
        );
    }
    public function delete($id)
    {
        DB::delete('user')->where('id','=')->execute([$id]);
        DB::delete('numero_paiement')->where('id_user','=')->execute([$id]);
        DB::delete('user_device')->where('id_user','=')->execute([$id]);
        DB::delete('messages')->where('id_user','=')->execute([$id]);
        DB::delete('offre')->where('id_acheteur','=')->or('id_vendeur','=')->execute([$id,$id]);
        DB::customQuery("DELETE notification_offre FROM notification_offre INNER JOIN historique_offre
                            ON notification_offre.id=historique_offre.id_notification_offre
                            WHERE notification_offre.id_user=?",[$id]);
        DB::customQuery("DELETE service_client FROM service_client INNER JOIN remboursement
                            ON service_client.id=remboursement.id_service
                            WHERE service_client.id_user=?",[$id]);
    }

    public function incrementAvis($id)
    {
        DB::customQuery("UPDATE user SET nbre_avis = nbre_avis+1 WHERE id=?",[$id]);
    }
    public function updateTotalNote($note, $id)
    {
        DB::customQuery("UPDATE user SET total_note = total_note+$note WHERE id=?",[$id]);
    }
    
    public function incrementActionCount($id, $action)
    {
        if($action === "achat")
        {
            DB::customQuery("UPDATE user SET nbre_achat = nbre_achat+1 WHERE id=?",[$id]);
        }
        else
        {
            DB::customQuery("UPDATE user SET nbre_vente = nbre_vente+1 WHERE id=?",[$id]);
        }
    }
    public function deposit($montant,$id)
    {
        DB::customQuery("UPDATE user SET soldes = soldes+$montant WHERE id=?",[$id]);
    }
    public function retrait($montant,$id)
    {
        DB::customQuery("UPDATE user SET soldes = soldes-$montant WHERE id=?",[$id]);
    }
}