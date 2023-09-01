<?php

class Logout extends APIController {

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->session->sess_destroy();
        echo json_encode([
            "success" => true
        ]);
    }
}