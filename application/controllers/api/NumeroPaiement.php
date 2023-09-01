<?php

class NumeroPaiement extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("NumeroPaiementModel","m_numero");
    }

    public function add()
    {
        $numero = CODE_PAYS . nospace($_POST['numero']);
        $proprietaire = trim($_POST['proprietaire']);
        $proprietaire_prenom = trim($_POST["proprietaire_prenom"]);
        $operateur = (int)$_POST["operateur"];
        if($this->m_numero->isUsed($numero))
        {
            echo json_encode([
                "success" => false,
            ]);
            exit();
        }
        $id_user = $this->session->userdata('userId');
        $this->m_numero->insert(["firstname_proprietaire","lastname_proprietaire","numero","id_user","operateur"],[$proprietaire,$proprietaire_prenom,$numero,$id_user,$operateur]);
        echo json_encode([
            "success" => true,
            "lists" => $this->m_numero->findBy(["id_user" => $id_user]),
        ]);
    }
}