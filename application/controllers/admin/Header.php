<?php

class Header extends AdminController {
    private $folder = null ;
    public function __construct()
    {
        parent::__construct();
        // $this->load->model("ServiceClientModel","m_service");
        $this->load->model("FrontModel","m_fm");
        
    }

    public function index()
    {
        $this->load->view("admin/header",[
            "dataH" => $this->m_fm->getHeader()
        ]);
    }

    public function getForm() {
        $this->load->view('admin/components/form_header',[
            "dataH" => $this->m_fm->getHeader()[0]
        ]);
    }

    public function update() {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("great_title","great_title","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("sub_great_title","sub_great_title","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("slogan","slogan","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("link_google_play","link_google_play","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("link_app_store","link_app_store","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        $this->form_validation->set_rules("image","image","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_header',[
                'dataH' => (object)$_POST,
            ]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                
            ]);
            // var_dump($_POST) ;
            exit();
        }

        $grandTitre = trim($_POST["great_title"]);
        $sousTitre = trim($_POST["sub_great_title"]);
        $slogan = trim($_POST['slogan']) ;
        $image = $_FILES["icon-file"];
        $apk = $_FILES["apk"];
        $image_name= trim($_POST["image"]) ;
        $linkPS = trim($_POST["link_google_play"]);
        $linkAS = trim($_POST["link_app_store"]);
        $this->folder = "public/images/" ;
        move_uploaded_file($image["tmp_name"],$this->folder . $image_name);
        move_uploaded_file($apk["tmp_name"],$this->folder . $apk["name"]);
        if($apk["size"] > 0) {
            $this->m_fm->updateHeader(["great_title","sub_great_title","slogan","link_google_play","link_app_store","image","apk"],[$grandTitre,$sousTitre,$slogan,$linkPS,$linkAS,$image_name,$apk["name"],1]) ;
        }
        else {
           $this->m_fm->updateHeader(["great_title","sub_great_title","slogan","link_google_play","link_app_store","image"],[$grandTitre,$sousTitre,$slogan,$linkPS,$linkAS,$image_name,1]) ; 
        }
        

        $page = "";
        ob_start();
        $this->load->view('admin/header',[
            "dataH" => $this->m_fm->getHeader()
        ]);
        $page = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $page,
        ]);





    }
}