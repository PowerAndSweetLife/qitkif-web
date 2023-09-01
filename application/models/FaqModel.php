<?php

class FaqModel extends CI_Model{

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

        return DB::customQuery("SELECT * FROM faq WHERE {$condition}",$data);
    }
    public function findOne($id)
    {
        return DB::select("faq")
            ->where('id','=')
            ->fetchOne([$id]);
    }
    public function all()
    {
        return DB::select("faq")
            ->execute();
    }
    public function insert($fields,$values)
    {
        DB::insert("faq")
            ->parametters($fields)
            ->execute($values);
    }
    public function update($fields,$values)
    {
        DB::update("faq")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }
    public function delete($id)
    {
        DB::delete("faq")
            ->where("id","=")
            ->execute([$id]);
    }

    public function filter($query)
    {
        return DB::select("faq")
            ->where("title"," LIKE ")
            ->or("content"," LIKE ")
            ->execute([$query,$query]);
    }

}