<?php

class Operateur extends AdminController {

    private $folder = null;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("OperateurModel","m_operateur");
        $this->load->model("NumeroPaiementModel","m_numero");
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

    public function index()
    {
        $this->load->view('admin/operateur',[
            "action" => "create",
            "lists" => $this->m_operateur->findAll(),
        ]);
    }
    public function getForm()
    {
        $this->load->view('admin/components/form_operateur',[
            'action' => 'create',
        ]);
    }

    public function create()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("nom","nom","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("logo","logo","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_operateur', ["action" => "create"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $nom = trim($_POST["nom"]);
        $file = $_FILES["logo-file"];
        $logo = trim($_POST["logo"]);

        move_uploaded_file($file["tmp_name"],$this->folder . $logo);
        $this->m_operateur->insert(["nom","logo"],[$nom,$logo]);

        $page = "";
        ob_start();
        $this->load->view('admin/operateur',[
            'action' => 'create',
            "lists" => $this->m_operateur->findAll()
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
        $operateur = $this->m_operateur->findOne($id);

        $this->load->view('admin/components/form_operateur',[
            'action' => 'update',
            'post' => $operateur,
        ]);
    }

    public function update()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("nom","nom","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("logo","logo","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_operateur', ["action" => "update"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $nom = trim($_POST["nom"]);
        $file = $_FILES["logo-file"];
        $logo = trim($_POST["logo"]);
        $id = (int)$_POST["id"];

        if($file["name"] !== "" && $file["size"] > 0) 
        {
            move_uploaded_file($file["tmp_name"],$this->folder . $logo);
        }
        $this->m_operateur->update(["nom","logo"],[$nom,$logo,$id]);

        $page = "";
        ob_start();
        $this->load->view('admin/operateur',[
            'action' => 'create',
            "lists" => $this->m_operateur->findAll()
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
        if($this->m_numero->findOneBy(["operateur" => $id]))
        {
            $this->load->view('admin/operateur',[
                'action' => 'create',
                "lists" => $this->m_operateur->findAll(),
                "delete_error" => true
            ]);

            return false;
        }
        $operateur = $this->m_operateur->findOne($id);
        unlink($this->folder . $operateur->logo);
        $this->m_operateur->delete($id);

        $this->load->view('admin/operateur',[
            'action' => 'create',
            "lists" => $this->m_operateur->findAll()
        ]);

    }
    public function filter()
    {
        $query = trim($_POST["query"]);
        $lists = [];
        if($query === "")
        {
            $lists = $this->m_operateur->findAll();
        }
        else
        {
            $lists = $this->m_operateur->filter("%" . $query . "%");
        }

        $this->load->view('admin/operateur',[
            'action' => 'create',
            "lists" => $lists,
            "query" => $query
        ]);
    }
}