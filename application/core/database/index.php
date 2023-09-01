<?php

require "DB.php";

$res = DB::insert("user")
            ->parametters(['name',"age","sexe"])
            ->execute(["Test",10,"M"]);
dump(DB::select('user')->execute());






function dump($debug)
{
    echo "<pre>";
    var_dump($debug);
    echo "</pre>";
}
