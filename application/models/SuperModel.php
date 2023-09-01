<?php 

class SuperModel extends CI_Model {

    protected $table;

    public function insert(array $fields, array $values)
    {
        DB::insert($this->table)
            ->parametters($fields)
            ->execute($values);
        $last = DB::customQuery("SELECT MAX(id) AS id FROM {$this->table}", [], false);
        return $last->id;
    }

    public function update(array $fields, array $values)
    {
        DB::update($this->table)
            ->parametters($fields)
            ->where("id","=")
            ->execute($values);
    }

    public function delete($id)
    {
        DB::delete($this->table)
            ->where("id","=")
            ->execute([$id]);
    }

    public function findBy(array $data)
    {
        return $this->_find($data, true);
    }

    public function findOneBy(array $data)
    {
        return $this->_find($data, false);
    }

    public function findById($id)
    {
        return DB::select($this->table)
                    ->where("id","=")
                    ->fetchOne([$id]);
    }

    public function findAll()
    {
        return DB::select($this->table)
                ->execute();
    }

    private function _find(array $data, $all)
    {
        $condition = "";
        foreach($data as $k => $v)
        {
            if(strlen($condition) === 0 )
            {
                $condition .= $k."=:".$k;
            }
            else
            {
                $condition .= " AND ".$k."=:".$k;
            }
        }

        return DB::customQuery("SELECT * FROM {$this->table} WHERE {$condition}",$data, $all);
    }

}