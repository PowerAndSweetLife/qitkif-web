<?php

class Logout extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->unset_userdata(["admin_connected","id"]);
        redirect(base_url('login'));
    }
}