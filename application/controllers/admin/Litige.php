<?php

class Litige extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ServiceClientModel","m_service");
        $this->load->model("UserModel","m_user");
        $this->load->model("OffreModel","m_offre");
    }

    public function index()
    {
        $this->load->view("admin/litige", [
            "lists" => $this->getLists()
        ]);
    }

    private function getLists()
    {
        $data = $this->m_service->findBy(["type" => "litige"]);
        foreach($data as $k => $v)
        {
            $data[$k]->acheteur = $this->m_user->findOneBy(["id" => $v->id_user]);
            $data[$k]->vendeur = $this->m_user->findOneBy(["id" => $v->id_vendeur]);
        }

        return $data;
    }
    public function resolved()
    {
        $id = (int)$_POST['id'];

        $this->m_service->update(['closed'],[1,$id]);
        $service = $this->m_service->findOneBy(["id" => $id]);
        if($service->id_offre)
        {
            $this->m_offre->update(["etat"], [Offre::CLOSE_SUCCESS, $service->id_offre]);
        }

        $this->index();
    }
}