<?php

class HistoriqueOffreModel extends CI_Model {

    public function insert($fields,$values)
    {
        DB::insert("historique_offre")
            ->parametters($fields)
            ->execute($values);
    }
}