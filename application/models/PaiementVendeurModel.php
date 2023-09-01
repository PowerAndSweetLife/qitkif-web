<?php

class PaiementVendeurModel extends CI_Model {
    const LIMIT = 20;
    public function insert($fields,$values)
    {
        DB::insert('paiement_vendeur')
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update('paiement_vendeur')
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function getCount()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM paiement_vendeur",[],false);
        return (int)$res->count;
    }
    public function paginate($offset=0)
    {
        return DB::customQuery("SELECT paiement_vendeur.id AS p_id,paiement_vendeur.montant,paiement_vendeur.is_paid,paiement_vendeur.date_,
            user.* FROM paiement_vendeur
            INNER JOIN user ON user.id=paiement_vendeur.id_vendeur
            LIMIT " . self::LIMIT . 
            " OFFSET " . $offset 
        );
    }

    public function getOne($id) 
    {
        return DB::select('paiement_vendeur')
                ->where('id','=')
                ->fetchOne([$id]);
    }

}