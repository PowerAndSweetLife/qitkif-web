<?php

class Propos extends AdminController {

    private $folder = null;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("FrontModel","m_fm");
    }

    public function index()
    {
        $this->load->view('admin/propos',[
            "dataP" => $this->m_fm->getPropos()
        ]);
    }

    public function getForm() {
        $this->load->view('admin/components/form_propos',[
            "dataP" => $this->m_fm->getPropos()[0]
        ]) ;
    }

    public function update() {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("titre","titre","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("contenu","contenu","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_propos');
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }

        $titre = trim($_POST["titre"]);
        $contenu = trim($_POST["contenu"]);
        $this->m_fm->updatePropos(["titre","contenu"],[$titre,$contenu,1]) ;
        $page = "";
        ob_start();
        $this->load->view('admin/propos',[
            "dataP" => $this->m_fm->getPropos()
        ]);
        $page = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $page,
        ]);
    }
    

}