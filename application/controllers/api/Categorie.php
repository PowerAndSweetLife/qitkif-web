<?php

class Categorie extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategorieModel','m_categorie');
    }

    public function get($type)
    {
        echo json_encode([
            "categories" => $this->m_categorie->findBy(["type" => urldecode($type)])
        ]);
    }
}