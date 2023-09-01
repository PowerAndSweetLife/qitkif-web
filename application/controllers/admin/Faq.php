<?php

class Faq extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FaqModel', 'faqModel');
    }

    public function index()
    {
        $this->load->view('admin/faq', [
            'lists' => $this->faqModel->all()
        ]);
    }

    public function getForm()
    {
        $this->load->view('admin/components/form_faq',[
            'action' => 'create',
        ]);
    }
    public function create()
    {
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("title","title","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("content","content","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_faq', ["action" => "create"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);

        $this->faqModel->insert(["title","content"],[$title,$content]);

        $page = "";
        ob_start();
        $this->load->view('admin/faq',[
            'action' => 'create',
            "lists" => $this->faqModel->all()
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
        $this->form_validation->set_rules("title","title","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("content","content","required",[
            "required" => "Ce champ est obligatoire"
        ]);

        
        if(!$this->form_validation->run())
        {
            $page = "";
            ob_start();
            $this->load->view('admin/components/form_faq', ["action" => "update"]);
            $page = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $page,
                'post' => $_POST,
            ]);
            exit();
        }
        
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $id = (int)$_POST["id"];


        $this->faqModel->update(["title","content"],[$title,$content,$id]);
        $page = "";
        ob_start();
        $this->load->view('admin/faq',[
            'action' => 'create',
            "lists" => $this->faqModel->all()
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
        $faq = $this->faqModel->findOne($id);

        $this->load->view('admin/components/form_faq',[
            'action' => 'update',
            'post' => $faq,
        ]);
    }

    public function delete()
    {
        $id = (int)$_POST["id"];
        
        $faq = $this->faqModel->findOne($id);


        $this->faqModel->delete($id);

        $this->load->view('admin/faq',[
            'action' => 'create',
            "lists" => $this->faqModel->all()
        ]);

    }
    public function filter()
    {
        $query = trim($_POST["query"]);
        $lists = [];
        if($query === "")
        {
            $lists = $this->faqModel->all();
        }
        else
        {
            $lists = $this->faqModel->filter("%" . $query . "%");
        }

        $this->load->view('admin/faq',[
            'action' => 'create',
            "lists" => $lists,
            "query" => $query
        ]);
    }

}