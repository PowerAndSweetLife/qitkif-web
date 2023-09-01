<?php

class PlateformeModel extends SuperModel {
    const LIMIT = 50;
    protected $table = "plateforme_transaction";
    public function get()
    {
        return DB::select("plateforme")
                    ->where("id","=")
                    ->fetchOne([1]);
    }
    public function updateSolde($montant)
    {
        DB::customQuery("UPDATE plateforme SET soldes=soldes+$montant WHERE id=1");
    }
    public function updateNbreCommission()
    {
        DB::customQuery("UPDATE plateforme SET nbre_commission=nbre_commission+1 WHERE id=1");
    }
    public function updateNbreRetrait()
    {
        DB::customQuery("UPDATE plateforme SET nbre_retrait=nbre_retrait+1 WHERE id=1");
    }
    public function history($offset=0)
    {
        return DB::customQuery("SELECT * FROM plateforme_transaction ORDER BY date_ DESC LIMIT " . self::LIMIT . " OFFSET {$offset}");
    }
    public function transactionCount()
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM plateforme_transaction", [], false);
        return (int)$res->count;
    }
}