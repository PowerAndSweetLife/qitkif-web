<?php



class Description extends AdminController {



    private $folder = null;

    public function __construct()

    {

        parent::__construct();

        $this->load->model("FrontModel","m_fm");

        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

    }



    public function index()

    {

        $this->load->view('admin/description',[

            "action" => "create",

            "lists" => $this->m_fm->getAllDescription(),

        ]);

    }

    public function getForm()

    {

        $this->load->view('admin/components/form_description',[

            'action' => 'create',

        ]);

    }



    public function create()

    {

        $this->form_validation->set_error_delimiters("","");

        $this->form_validation->set_rules("entete","entete","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("contenu","contenu","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("logo","logo","required",[

            "required" => "Ce champ est obligatoire"

        ]);



        

        if(!$this->form_validation->run())

        {

            $page = "";

            ob_start();

            $this->load->view('admin/components/form_description', ["action" => "create"]);

            $page = ob_get_clean();

            echo json_encode([

                "success" => false,

                "page" => $page,

                'post' => $_POST,

            ]);

            exit();

        }

        

        $entete = trim($_POST["entete"]);

        $image = $_FILES["logo-file"];

        $image_name = trim($_POST["logo"]) ;

        $contenu = trim($_POST["contenu"]);



        move_uploaded_file($image["tmp_name"],$this->folder . $image_name);

        

        $this->m_fm->insertDescription(["entete","contenu","image"],[$entete,$contenu,$image_name]);



        $page = "";

        ob_start();

        $this->load->view('admin/description',[

            'action' => 'create',

            "lists" => $this->m_fm->getAllDescription()

        ]);

        $page = ob_get_clean();

        echo json_encode([

            "success" => true,

            "page" => $page,

        ]);

    }

    

    public function show()

    {

        $id = (int)$_GET["id"];

        $description = $this->m_fm->findOneDescription($id);



        $this->load->view('admin/components/form_description',[

            'action' => 'update',

            'post' => $description,

        ]);

    }



    public function update()

    {

        // var_dump($_POST) ;
        $this->form_validation->set_error_delimiters("","");

        $this->form_validation->set_rules("entete","entete","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("contenu","contenu","required",[

            "required" => "Ce champ est obligatoire"

        ]);

        $this->form_validation->set_rules("logo","logo","required",[

            "required" => "Ce champ est obligatoire"

        ]);



        // var_dump($_FILES) ;

        if(!$this->form_validation->run())

        {

            $page = "";

            ob_start();

            $this->load->view('admin/components/form_description', ["action" => "update"]);

            $page = ob_get_clean();

            echo json_encode([

                "success" => false,

                "page" => $page,

                'post' => $_POST,

            ]);

            exit();

        }

        

        $entete = trim($_POST["entete"]);

        $image = $_FILES["logo-file"];

        $image_name = trim($_POST["logo"]) ;

        $contenu = trim($_POST["contenu"]);

        $id = (int)$_POST["id"];



        if($image["name"] !== "" && $image["size"] > 0) 

        {

            move_uploaded_file($image["tmp_name"],$this->folder . $image['name']);
            $image_name = $image['name'] ;
        }   
        // var_dump($_POST) ;
        $this->m_fm->updateDescription(["entete","contenu","image"],[$entete,$contenu,$image_name,$id]);



        $page = "";

        ob_start();

        $this->load->view('admin/description',[

            'action' => 'create',

            "lists" => $this->m_fm->getAllDescription()

        ]);

        $page = ob_get_clean();

        echo json_encode([

            "success" => true,

            "page" => $page,

        ]);

    }



    public function delete()

    {

        $id = (int)$_POST["id"];

        $description = $this->m_fm->findOneDescription($id);

        unlink($this->folder . $description->image);

        $this->m_fm->deleteDescription($id);



        $this->load->view('admin/description',[

            'action' => 'create',

            "lists" => $this->m_fm->getAllDescription()

        ]);



    }

    public function filter()

    {

        $query = trim($_POST["query"]);

        $lists = [];

        if($query === "")

        {

            $lists = $this->m_fm->getAllDescription();

        }

        else

        {

            $lists = $this->m_fm->filter("%" . $query . "%");

        }



        $this->load->view('admin/description',[

            'action' => 'create',

            "lists" => $lists,

            "query" => $query

        ]);

    }

}