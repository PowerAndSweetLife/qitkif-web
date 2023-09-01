<?php

class Promotion extends AdminController {

    private $folder = null;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("PromotionModel","m_promotion");
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'icon_promotion' . DIRECTORY_SEPARATOR;
    }

    public function index()
    {
        $this->load->view("admin/promotion",[
            "action" => "create",
            "lists" => $this->m_promotion->all()
        ]);
    }
    public function getForm()
    {
        $this->load->view('admin/components/form_promotion',[
            'action' => 'create',
        ]);
    }

    public function create()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("lien","lien","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("message","message","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("icon","icon","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_promotion', ["action" => "create"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $lien = trim($_POST["lien"]);
        $message = trim($_POST["message"]);
        $file = $_FILES["icon-file"];
        $icon = trim($_POST["icon"]);

        move_uploaded_file($file["tmp_name"],$this->folder . $icon);
        $this->m_promotion->insert(["lien","message","icon", "created_at"],[$lien,$message,$icon, now()]);

        $page = "";
        ob_start();
        $this->load->view('admin/promotion',[
            'action' => 'create',
            "lists" => $this->m_promotion->all()
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
        $promotion = $this->m_promotion->findOne($id);

        $this->load->view('admin/components/form_promotion',[
            'action' => 'update',
            'post' => $promotion,
        ]);
    }

    public function update()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("lien","lien","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("message","message","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("icon","icon","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_promotion', ["action" => "update"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $lien = trim($_POST["lien"]);
        $message = trim($_POST["message"]);
        $file = $_FILES["icon-file"];
        $icon = trim($_POST["icon"]);
        $id = (int)$_POST["id"];

        if($file["name"] !== "" && $file["size"] > 0)
        {
            move_uploaded_file($file["tmp_name"],$this->folder . $icon);
        }
        $this->m_promotion->update(["lien","message","icon"],[$lien,$message,$icon,$id]);
        $page = "";
        ob_start();
        $this->load->view('admin/promotion',[
            'action' => 'create',
            "lists" => $this->m_promotion->all()
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
        $promotion = $this->m_promotion->findOne($id);
        
        if(file_exists($this->folder . $promotion->icon)) {
            unlink($this->folder . $promotion->icon);
        }
        
        $this->m_promotion->delete($id);

        $this->load->view('admin/promotion',[
            'action' => 'create',
            "lists" => $this->m_promotion->all()
        ]);

    }
    public function filter()
    {
        $query = trim($_POST["query"]);
        $lists = [];
        if($query === "")
        {
            $lists = $this->m_promotion->all();
        }
        else
        {
            $lists = $this->m_promotion->filter("%" . $query . "%");
        }

        $this->load->view('admin/promotion',[
            'action' => 'create',
            "lists" => $lists,
            "query" => $query
        ]);
    }
}