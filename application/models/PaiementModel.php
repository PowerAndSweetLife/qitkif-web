<?php

class PaiementModel extends CI_Model {
    const LIMIT = 20;
    public function insert($fields,$values)
    {
        DB::insert('paiement')
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update('paiement')
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function getCount()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM paiement",[],false);
        return (int)$res->count;
    }
    public function paginate($offset=0)
    {
        return DB::customQuery("SELECT paiement.id AS p_id,paiement.montant,paiement.is_paid,paiement.date_,
            user.* FROM paiement
            INNER JOIN user ON user.id=paiement.id_vendeur
            LIMIT " . self::LIMIT . 
            " OFFSET " . $offset 
        );
    }

    public function getOne($id) 
    {
        return DB::select('paiement')
                ->where('id','=')
                ->fetchOne([$id]);
    }

}