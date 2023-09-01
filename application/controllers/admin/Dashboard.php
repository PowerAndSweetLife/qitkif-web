<?php

class Dashboard extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CategorieModel","m_categorie");
        $this->load->model("MessagesModel","m_message");
        $this->load->model("FrontModel","m_fm") ;
    }

    public function index()
    {
        $this->load->view('admin/index',[
            "action" => "create",
            "lists" => $this->m_categorie->all(),
            "unreadMessage" => $this->m_message->unreadCountBy(["read_by_admin" => 0]),
            "dataH" => $this->m_fm->getHeader()
        ]);
    }
}