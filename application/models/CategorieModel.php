<?php

class CategorieModel extends CI_Model {

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

        return DB::customQuery("SELECT * FROM categorie WHERE {$condition}",$data);
    }
    public function findOne($id)
    {
        return DB::select("categorie")
            ->where('id','=')
            ->fetchOne([$id]);
    }
    public function all()
    {
        return DB::select("categorie")
            ->order(["id" => "DESC"])
            ->execute();
    }
    public function insert($fields,$values)
    {
        DB::insert("categorie")
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update("categorie")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function delete($id)
    {
        DB::delete("categorie")
            ->where("id","=")
            ->execute([$id]);
    }

    public function filter($query)
    {
        return DB::select("categorie")
            ->where("nom"," LIKE ")
            ->or("type"," LIKE ")
            ->execute([$query,$query]);
    }
}