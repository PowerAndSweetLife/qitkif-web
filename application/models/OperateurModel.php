<?php

class OperateurModel extends CI_Model {

    public function findAll()
    {
        return DB::select("operateur_telephonique")
                    ->execute();
    }

    public function findOne($id)
    {
        return DB::select("operateur_telephonique")
                ->where("id","=")
                ->fetchOne([$id]);
    }

    public function insert($fields,$values)
    {
        DB::insert("operateur_telephonique")
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update("operateur_telephonique")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }

    public function delete($id)
    {
        DB::delete("operateur_telephonique")
            ->where("id","=")
            ->execute([$id]);
    }

    public function filter($query)
    {
        return DB::select("operateur_telephonique")
                ->where("nom"," LIKE ")
                ->execute([$query]);
    }

}