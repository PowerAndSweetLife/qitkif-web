<?php

class FrontModel extends CI_Model {

    // public function getHeader() {
    //     return DB::select("fo_header")
    //         ->execute();
    // }
    // public function getSlogan() {
    //     return DB::select("fo_slogan")
    //         ->execute();
    // }

    public function getHeader() {
    	return DB::select("fo_header")->execute() ;
    }

    public function getSlogan() {
    	return DB::select("fo_slogan")->execute() ;
    }

    public function getPropos() {
    	return DB::select("propos")->execute() ;
    }

    public function getFunctionality() {
    	return DB::select("functionality")->execute() ;
    }
    public function getAllDescription() {
    	return DB::select("description")->execute() ;
    }

    public function insertDescription($fields,$data) {
    	DB::insert("description")
    	    ->parametters($fields)
    	    ->execute($data) ;
    }

    public function getAllContact() {
    	return DB::select("contact")->execute() ;
    }

    public function findOneDescription($id) {
    	$res = DB::select("description")
    	           ->where("id","=")
    	           ->execute(array($id)) ;
    	return $res[0] ;
    }

    public function updateDescription($fields,$data) {

    	DB::update("description")
    		->parametters($fields)
    		->where("id","=")
    		->execute($data) ;
    }

    public function deleteDescription($id) {
    	DB::delete("description")
    	           ->where("id","=")
    	           ->execute(array($id)) ;
    }

    public function filter($data) {
    	return DB::customQuery("SELECT * FROM description WHERE entete LIKE '{$data}'") ;
    }

    public function updateFunctionality($fields,$data) {
    	DB::update("functionality")
    	   ->parametters($fields)
    	   ->where("id","=")
    	   ->execute($data) ;
    }

    public function updateContact($fields,$data) {
    	DB::update("contact")
    	   ->parametters($fields)
    	   ->where("idcontact","=")
    	   ->execute($data) ;
    }
    public function updateHeader($fields,$data) {
    	DB::update("fo_header")
    	    ->parametters($fields)
    	    ->where("id","=")
    	    ->execute($data) ;
    }
    
}