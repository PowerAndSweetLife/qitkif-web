<?php



class Contact extends AdminController {



    private $folder = null;

    public function __construct()

    {

        parent::__construct();

        $this->load->model("FrontModel","m_fm");

    }



    public function index()

    {

        $this->load->view('admin/contact',[

            "contact" => $this->m_fm->getAllContact() ,

        ]);

    }



    public function getForm() {

        $this->load->view('admin/components/form_contact',[

            "contact" => $this->m_fm->getAllContact()[0] ,

        ]) ;

    }



    public function update() {

        $this->form_validation->set_error_delimiters("","");

        $this->form_validation->set_rules("whatsapp","whatsapp","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("facebook","facebook","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("adresse","adresse","required",[

            "required" => "Ce champ est obligatoire"

        ]);



        if(!$this->form_validation->run())

        {

            $page = "";

            ob_start();

            $this->load->view('admin/components/form_contact');

            $page = ob_get_clean();

            echo json_encode([

                "success" => false,

                "page" => $page,

                'post' => $_POST,

            ]);

            exit();

        }



        $whatsapp = trim($_POST["whatsapp"]);

        $facebook = trim($_POST["facebook"]);

        $adresse = trim($_POST["adresse"]);

        $this->m_fm->updateContact(["whatsapp","facebook","adresse"],[$whatsapp,$facebook,$adresse,1]) ;

        $page = "";

        ob_start();

        $this->load->view('admin/contact',[

            "contact" => $this->m_fm->getAllContact()

        ]);

        $page = ob_get_clean();

        echo json_encode([

            "success" => true,

            "page" => $page,

        ]);

    }

    



}