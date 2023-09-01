<?php

class AdminController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('admin_connected'))
        {
            redirect(base_url('login'));
            exit();
        }
        if (!$this->input->is_ajax_request())
        {
            //http_response_code(403);
        }
    }
}
