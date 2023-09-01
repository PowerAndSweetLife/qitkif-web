<?php

class AvisModel extends CI_Model {

    public function insert($fields,$values) 
    {
        DB::insert("avis")
            ->parametters($fields)
            ->execute($values);
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

        return DB::customQuery("SELECT * FROM avis WHERE {$condition}",$data,false);
    }
}