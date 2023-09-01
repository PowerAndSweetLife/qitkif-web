<?php

class Remboursement extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ServiceClientModel","m_service");
        $this->load->model("UserModel","m_user");
        $this->load->model("OffreModel","m_offre");
        $this->load->model("NumeroPaiementModel","m_numero");
        $this->load->model('TransactionModel','m_transaction');
    }

    public function index()
    {
        $this->load->view('admin/remboursement', [
            "lists" => $this->getLists()
        ]);
    }

    public function show()
    {
        $id = (int)$_GET["idService"];
        $data = $this->m_service->findOneBy(["id" => $id]);
        $offre = $this->m_offre->findOne($data->id_offre);
        $acheteur = $this->m_user->findOneBy(["id" => $data->id_user]);

        $this->load->view('admin/components/form_remboursement',[
            "post" => (object) [
                "pseudo" => $acheteur->pseudo,
                "montant" => $offre->montant,
                "idService" => $id,
            ],
        ]);
    }

    public function create()
    {
        $errors = (object) [
            "numero" => null,
            "montant" => null
        ];
        $error_post = false;
        if(trim($_POST["montant"]) === "")
        {
            $error_post = true;
            $errors->montant = "Veuillez indiquer le montant";
        }
        if($error_post)
        {
            echo json_encode([
                "success" => false,
                "error_post" => true,
                "errors" => $errors
            ]);
            exit();
        }
        
        $montant = (int)nospace($_POST["montant"]);
        $idService = (int)$_POST["idService"];

        $data = $this->m_service->findOneBy(["id" => $idService]);

        $this->m_service->update(["closed"],[1,$idService]);
        $this->m_user->deposit($montant, $data->id_user);
        $this->m_transaction->insert(["id_user","id_offre","montant","motif"], [$data->id_user,$data->id_offre,$montant,"remboursement"]);

        echo json_encode(["success" => true]);

        /**
         * Crediter le compte à rembourser
         */
        payOut($this->m_user->findOneBy(['id' => $data->id_user]), $montant);
    }

    private function getLists()
    {
        $data = $this->m_service->findBy(["type" => "litige", "closed" => 0]);
        foreach($data as $k => $v)
        {
            $data[$k]->acheteur = $this->m_user->findOneBy(["id" => $v->id_user]);
            $data[$k]->vendeur = $this->m_user->findOneBy(["id" => $v->id_vendeur]);
            $data[$k]->offre = $this->m_offre->findOne($v->id_offre);
        }

        return $data;
    }
}