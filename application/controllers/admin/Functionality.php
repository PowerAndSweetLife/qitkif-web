<?php

class Functionality extends AdminController {
    private $folder = null ;
    public function __construct()
    {
        parent::__construct();
        // $this->load->model("ServiceClientModel","m_service");
        $this->load->model("FrontModel","m_fm");
        
    }

    public function index()
    {
        $this->load->view("admin/functionality",[
            "dataF" => $this->m_fm->getFunctionality()
        ]);
    }

    public function getForm() {
        $this->load->view('admin/components/form_functionality',[
            "dataF" => $this->m_fm->getFunctionality()[0]
        ]);
    }

    public function update() {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("func1","func1","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("func2","func2","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("func3","func3","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("func4","func4","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        $this->form_validation->set_rules("content1","content1","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("content2","content2","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("content3","content3","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("content4","content4","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_functionality',[
                'dataF' => (object)$_POST,
            ]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
            ]);
            exit();
        }

        $func1 = trim($_POST["func1"]);
        $func2 = trim($_POST["func2"]);
        $func3 = trim($_POST["func3"]);
        $func4 = trim($_POST["func4"]);
        $content1 = trim($_POST["content1"]);
        $content2 = trim($_POST["content2"]);
        $content3 = trim($_POST["content3"]);
        $content4 = trim($_POST["content4"]);

        $this->m_fm->updateFunctionality(["func1","func2","func3","func4","content1","content2","content3","content4"],[$func1,$func2,$func3,$func4,$content1,$content2,$content3,$content4,1]) ;

        $page = "";
        ob_start();
        $this->load->view('admin/functionality',[
            "dataF" => $this->m_fm->getFunctionality()
        ]);
        $page = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $page,
        ]);





    }
}