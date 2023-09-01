<?php 

class AdminModel extends CI_Model {

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

        return DB::customQuery("SELECT * FROM `admin` WHERE {$condition}",$data, false);
    }

    public function update($fields,$values)
    {
        DB::update("admin")
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }

}