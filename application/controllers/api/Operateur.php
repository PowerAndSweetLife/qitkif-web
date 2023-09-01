<?php

class Operateur extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("OperateurModel","m_operator");
    }
    public function all()
    {
        echo json_encode(["operateurs" => $this->m_operator->findAll()]);
    }
}