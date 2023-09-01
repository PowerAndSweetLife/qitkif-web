<?php

class Paiement extends AdminController {
    public function __construct()
    {
        http_response_code(404);
        exit();
        parent::__construct();
        $this->load->model('PaiementVendeurModel','pay_vendeur');
        $this->load->model('UserModel','m_user');
        $this->load->model('NumeroPaiementModel','m_numero');
        $this->load->model('TransactionModel','m_transaction');
    }

    public function index()
    {
        $lists = $this->pay_vendeur->paginate();
        $isPaginate = false;
        $count = $this->pay_vendeur->getCount();

        if($count > PaiementVendeurModel::LIMIT)
        {
            $isPaginate = true;
        }
        
        if($count > PaiementVendeurModel::LIMIT)
        {
            $isPaginate = true;
        }
        $this->load->view('admin/paiement_vendeur', [
            "lists" => $lists,
            "currentPage" => 1,
            "isPaginate" => $isPaginate,
            "isLast" => false,
            // "nPages" => $nPages,
        ]);
    }
    public function page(int $page)
    {
        $isPaginate = false;
        $count = $this->pay_vendeur->getCount();
        $nPages = ceil($count/PaiementVendeurModel::LIMIT);
        $offset = ($page - 1) * PaiementVendeurModel::LIMIT;
        $isLast = false;
        if($nPages === $page)
        {
            $isLast = true;
        }
        $lists = $this->pay_vendeur->paginate($offset);
        
        if($count > PaiementVendeurModel::LIMIT)
        {
            $isPaginate = true;
        }

        $this->load->view("admin/components/table_paiement_vendeur", [
            "lists" => $lists,
            "currentPage" => $page,
            "isPaginate" => $isPaginate,
            "isLast" => $isLast,
            // "nPages" => $nPages,
        ]);
    }

    public function show() {
        $idPaiement = (int)$_GET['idPaiement'];
        $data = $this->pay_vendeur->getOne($idPaiement);
        $vendeur = $this->m_user->findOneBy(["id" => $data->id_vendeur]);
        //$numeros = $this->m_numero->findBy(["id_user" => $data->id_vendeur]);

        $this->load->view('admin/components/form_paiement_vendeur',[
            "post" => (object) [
                "pseudo" => $vendeur->pseudo,
                "montant" => $data->montant,
                "idPaiement" => $idPaiement,
            ],
            //"numeros" => $numeros
        ]);
    }
    public function vendeur()
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
        
        
        $idPaiement = (int)$_POST["idPaiement"];
        $montant = (int)nospace($_POST["montant"]);
        
        $data = $this->pay_vendeur->getOne($idPaiement);
        $this->pay_vendeur->update(["is_paid"],[1,$idPaiement]);
        $this->m_transaction->insert(["id_user","id_offre","montant","motif"],[$data->id_vendeur,$data->id_offre,$montant,"vente"]);
        $this->m_user->deposit($montant, $data->id_vendeur);

        echo json_encode(["success" => true]);
    }

    
}