<?php

class Categorie extends AdminController {

    private $folder = null;
    public function __construct()
    {
        parent::__construct();
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'icon_categorie' . DIRECTORY_SEPARATOR;
        $this->load->model("CategorieModel","m_categorie");
        $this->load->model("OffreModel","m_offre");
    }

    public function index()
    {
        $this->load->view('admin/categorie',[
            "action" => "create",
            "lists" => $this->m_categorie->all()
        ]);
    }
    public function getForm()
    {
        $this->load->view('admin/components/form_categorie',[
            'action' => 'create',
        ]);
    }
    public function create()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("nom","nom","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("type","type","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("icon","icon","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_categorie', ["action" => "create"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $nom = trim($_POST["nom"]);
        $type = trim($_POST["type"]);
        $file = $_FILES["icon-file"];
        $icon = trim($_POST["icon"]);

        move_uploaded_file($file["tmp_name"],$this->folder . $icon);
        $this->m_categorie->insert(["nom","type","icon"],[$nom,$type,$icon]);

        $page = "";
        ob_start();
        $this->load->view('admin/categorie',[
            'action' => 'create',
            "lists" => $this->m_categorie->all()
        ]);
        $page = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $page,
        ]);
    }

    public function update()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("nom","nom","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("type","type","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("icon","icon","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_categorie', ["action" => "update"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $nom = trim($_POST["nom"]);
        $type = trim($_POST["type"]);
        $file = $_FILES["icon-file"];
        $icon = trim($_POST["icon"]);
        $id = (int)$_POST["id"];

        if($file["name"] !== "" && $file["size"] > 0)
        {
            move_uploaded_file($file["tmp_name"],$this->folder . $icon);
        }
        $this->m_categorie->update(["nom","type","icon"],[$nom,$type,$icon,$id]);
        $page = "";
        ob_start();
        $this->load->view('admin/categorie',[
            'action' => 'create',
            "lists" => $this->m_categorie->all()
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
        $categorie = $this->m_categorie->findOne($id);

        $this->load->view('admin/components/form_categorie',[
            'action' => 'update',
            'post' => $categorie,
        ]);
    }

    public function delete()
    {
        $id = (int)$_POST["id"];
        if($this->m_offre->findOneBy(["id_categorie" => $id]))
        {
            $this->load->view('admin/categorie',[
                'action' => 'create',
                "lists" => $this->m_categorie->all(),
                "delete_error" => true,
            ]);

            return false;
        }
        $categorie = $this->m_categorie->findOne($id);
        if(file_exists($this->folder . $categorie->icon)) {
            unlink($this->folder . $categorie->icon);
        }
        
        $this->m_categorie->delete($id);

        $this->load->view('admin/categorie',[
            'action' => 'create',
            "lists" => $this->m_categorie->all()
        ]);

    }
    public function filter()
    {
        $query = trim($_POST["query"]);
        $lists = [];
        if($query === "")
        {
            $lists = $this->m_categorie->all();
        }
        else
        {
            $lists = $this->m_categorie->filter("%" . $query . "%");
        }

        $this->load->view('admin/categorie',[
            'action' => 'create',
            "lists" => $lists,
            "query" => $query
        ]);
    }

}