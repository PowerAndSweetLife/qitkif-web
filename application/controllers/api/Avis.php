<?php

class Avis extends APIController {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AvisModel","m_avis");
        $this->load->model("UserModel","m_user");
        
    }

    public function add() 
    {
        $idUser = (int)$_POST["idUser"];
        $note = (int)$_POST["note"];
        $comment = isset($_POST["comment"]) ? trim($_POST["comment"]) : null;
        $idUserAvis = (int)$this->session->userdata("userId");

        if($this->m_avis->findOneBy(["id_user" => $idUser, "id_user_avis" => $idUserAvis]))
        {
            exit();
        }
        $this->m_avis->insert(["id_user","id_user_avis","note","comment","date_"],[$idUser,$idUserAvis,$note,$comment,now()]);
        $this->m_user->incrementAvis($idUser);
        $this->m_user->updateTotalNote($note,$idUser);
        echo json_encode(["success" => true]);
    }
}