<?php

class Tutoriels extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("FrontModel","m_front");
    }

    public function index()
    {
        return redirect(base_url('tutoriels/vendre'));
    }
    
    public function acheter() 
    {
        $this->load->view('front-office/components/header', [
            'withRedirection' => true,
            'active' => 'acheter',
            "contact" => $this->m_front->getAllContact() ,
        ]);
        $this->load->view('front-office/tutoriels-acheter');        
        $this->load->view('front-office/components/footer');
    }

    public function vendre()
    {
        $this->load->view('front-office/components/header', [
            'withRedirection' => true,
            'active' => 'vendre',
            "contact" => $this->m_front->getAllContact() ,
        ]);
        $this->load->view('front-office/tutoriels-vendre');        
        $this->load->view('front-office/components/footer');
    }

}