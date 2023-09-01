<?php

class APIController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata("connected"))
        {
            http_response_code(403);
            exit();
        }
    }
}