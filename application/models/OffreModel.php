<?php

class OffreMOdel extends CI_Model {

    public function insert($fields,$values)
    {
        DB::insert("offre")
            ->parametters($fields)
            ->execute($values);
        $last = DB::customQuery("SELECT MAX(id) AS id FROM offre LIMIT 1",[],false);
        return (int)$last->id;
    }
    public function update($fields,$values)
    {
        DB::update("offre")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function findAllCancelOrCloseByUserId($userId)
    {
        return DB::customQuery("SELECT offre.*,
            categorie.nom AS categorie 
            FROM offre 
            INNER JOIN categorie ON categorie.id=offre.id_categorie
            WHERE (id_acheteur=? OR id_vendeur=?) 
            AND (etat=? OR etat=?) ORDER BY updated_at DESC",
        [
            $userId,
            $userId,
            Offre::CLOSE_NOT_SUCCESS,
            Offre::CLOSE_SUCCESS
        ]);
    }
    
    public function findAllInProgressByUserId($userId)
    {
        return DB::customQuery("SELECT offre.*,
            categorie.nom AS categorie 
            FROM offre 
            INNER JOIN categorie ON categorie.id=offre.id_categorie
            WHERE (id_acheteur=? OR id_vendeur=?) 
            AND (etat!=? AND etat!=?) ORDER BY updated_at DESC",
        [
            $userId,
            $userId,
            Offre::CLOSE_NOT_SUCCESS,
            Offre::CLOSE_SUCCESS
        ]);
    }
    public function findOne($id)
    {
        $res = DB::select("offre")
                    ->where("id","=")
                    ->fetchOne([$id]);
        if($res) 
        {
            $cat = DB::select("categorie")->where("id","=")->fetchOne([$res->id_categorie]);
            $res->categorie = $cat;
            return $res;
        }
        return false;
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

        return DB::customQuery("SELECT * FROM offre WHERE {$condition}",$data,false);
    }

    public function paginate($offset = 0)
    {
        return DB::customQuery("SELECT * FROM offre LIMIT " . UserModel::LIMIT . " OFFSET " . $offset);
    }

    public function getCount()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM offre",[], false);
        return (int)$res->count;
    }
    public function filterAll($query)
    {
        return DB::customQuery("SELECT offre.*,a.pseudo AS acheteur,v.pseudo AS vendeur,c.nom AS categorie
            FROM offre
            LEFT JOIN categorie AS c ON c.id=offre.id_categorie
            LEFT JOIN user AS a ON a.id=offre.id_acheteur
            LEFT JOIN user AS v ON v.id=offre.id_vendeur 
            WHERE offre.nom_objet LIKE ?
            OR offre.id LIKE ?
            OR offre.action LIKE ?
            OR offre.mode_remise LIKE ?
            OR a.pseudo LIKE ?
            OR v.pseudo LIKE ?
            OR c.nom LIKE ?",
            [$query,$query,$query,$query,$query,$query,$query]
        );
    }

    public function delete($id)
    {
        DB::delete('offre')->where("id","=")->execute([$id]);
        DB::customQuery("DELETE notification_offre FROM notification_offre INNER JOIN historique_offre
                ON notification_offre.id=historique_offre.id_notification_offre
                WHERE notification_offre.id=?",[$id]);
        DB::customQuery("DELETE service_client FROM service_client INNER JOIN remboursement
                            ON service_client.id=remboursement.id_service
                            WHERE service_client.id_offre=?",[$id]);
    }

    public function selectOffre($id_user)
    {
        $data = DB::customQuery("SELECT offre.*, user.id AS user_id, user.pseudo FROM offre INNER JOIN user
                                ON offre.id_vendeur=user.id WHERE offre.id_acheteur=? AND offre.etat<? AND offre.expired=0",[
                                    $id_user, Offre::CLOSE_SUCCESS
                                ]);
        foreach($data as $k => $v)
        {
            $data[$k]->reference = getOffreReference($v->id);
        }
        return $data;
    }

}