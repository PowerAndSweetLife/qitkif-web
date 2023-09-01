<?php

class PromotionModel extends CI_Model {

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

        return DB::customQuery("SELECT * FROM promotion WHERE {$condition}",$data);
    }
    public function findOne($id)
    {
        return DB::select("promotion")
            ->where('id','=')
            ->fetchOne([$id]);
    }
    public function all()
    {
        return DB::select("promotion")
            ->order(["id" => "DESC"])
            ->execute();
    }
    public function insert($fields,$values)
    {
        DB::insert("promotion")
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update("promotion")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function delete($id)
    {
        DB::delete("promotion")
            ->where("id","=")
            ->execute([$id]);
    }

    public function filter($query)
    {
        return DB::select("promotion")
            ->where("lien"," LIKE ")
            ->or("message"," LIKE ")
            ->execute([$query,$query]);
    }
}