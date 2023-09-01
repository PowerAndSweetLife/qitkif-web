<?php

class NumeroPaiementModel extends CI_Model {

    public function insert($fields,$values)
    {
        DB::insert("numero_paiement")
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

        return DB::customQuery("SELECT numero_paiement.*,
            o.logo 
            FROM numero_paiement
            LEFT JOIN operateur_telephonique AS o
            ON o.id=numero_paiement.operateur 
            WHERE {$condition}",$data
        );
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

        return DB::customQuery("SELECT * FROM numero_paiement WHERE {$condition}",$data,false);
    }
    public function isUsed($numero)
    {
        if($this->findOneBy(["numero" => $numero]))
        {
            return true;
        }
        return false;
    }
}