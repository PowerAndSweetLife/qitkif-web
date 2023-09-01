<?php

class TransactionModel extends CI_Model {

    public function insert($fields,$values) {
        DB::insert("transaction")
            ->parametters($fields)
            ->execute($values);
    }
    
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

        return DB::customQuery("SELECT * FROM `transaction` WHERE {$condition} ORDER BY date_ DESC",$data);
    }

}