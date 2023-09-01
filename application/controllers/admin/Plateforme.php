<?php

class Plateforme extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PlateformeModel","m_plateforme");
        $this->load->model("PlateformeNumeroModel","m_numero");
    }
    // public function add()
    // {
    //     for($i=0;$i<1000;$i++){
    //         DB::insert("plateforme_transaction")
    //             ->parametters(["motif","montant"])
    //             ->execute(["retrait", $i]);
    //     }
    // }
    public function compte()
    {
        $count = $this->m_plateforme->transactionCount();
        $page = 1;
        $nbrePage = ceil($count / PlateformeModel::LIMIT);
        $this->load->view("admin/compte_plateforme", [
            "compte" => $this->m_plateforme->get(),
            "histories" => $this->m_plateforme->history(),
            "pagination" => $count > PlateformeModel::LIMIT,
            "page" => $page,
            "nbrePage" => $nbrePage,
        ]);
    }

    public function numero()
    {
        $this->load->view("admin/compte_numero",[
            "lists" => $this->m_numero->findAll(),
            "action" => "create",
        ]);
    }

    public function createNumero()
    {
        $numero = CODE_PAYS . nospace($_POST["numero"]);
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);

        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("numero","numero","required|is_unique[plateforme_numero.numero]",[
            "required" => "Ce champ est obligatoire",
            "is_unique" => "Ce numéro est déjà enregistrer"
        ]);
        $this->form_validation->set_rules("firstname","firstname","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("lastname","lastname","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view("admin/components/form_plateforme_numero", [
                "action" => "create",
                "post" => (object)$_POST,
            ]);
            $content = ob_get_clean();

            echo json_encode([
                "success" => false,
                "page" => $content
            ]);
            exit();
        }
        
        $this->m_numero->insert(["numero","firstname","lastname"], [$numero, $firstname, $lastname]);
        ob_start();
        $this->numero();
        $content = ob_get_clean();

        echo json_encode([
            "success" => true,
            "page" => $content,
        ]);

    }
    public function getOneNumero()
    {
        $id = (int)$_GET["id"];
        $data = $this->m_numero->findById($id);
        $data->numero = str_replace("+225","",$data->numero);
        $this->load->view("admin/components/form_plateforme_numero", [
            "action" => "update",
            "post" => $data,
        ]);
    }

    public function updateNumero()
    {
        $numero = CODE_PAYS . nospace($_POST["numero"]);
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $id = (int)$_POST["id"];
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("numero","numero","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("firstname","firstname","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        $this->form_validation->set_rules("lastname","lastname","required",[
            "required" => "Ce champ est obligatoire"
        ]);
        
        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view("admin/components/form_plateforme_numero", [
                "action" => "update",
                "post" => (object)$_POST,
            ]);
            $content = ob_get_clean();

            echo json_encode([
                "success" => false,
                "page" => $content
            ]);
            exit();
        }
        $data = $this->m_numero->findById($id);
        if($numero !== $data->numero)
        {
            $this->form_validation->set_rules("numero","numero","is_unique[plateforme_numero.numero]",[
                "is_unique" => "Ce numéro est déjà enregistrer"
            ]);
            if(!$this->form_validation->run())
            {
                ob_start();
                $this->load->view("admin/components/form_plateforme_numero", [
                    "action" => "update",
                    "post" => (object)$_POST,
                ]);
                $content = ob_get_clean();

                echo json_encode([
                    "success" => false,
                    "page" => $content
                ]);
                exit();
            }
        }

        $this->m_numero->update(["numero","firstname","lastname"], [$numero,$firstname,$lastname,$id]);
        ob_start();
        $this->numero();
        $content = ob_get_clean();

        echo json_encode([
            "success" => true,
            "page" => $content,
        ]);
    }
    public function deleteNumero()
    {
        $id = (int)$_POST["id"];
        $this->m_numero->delete($id);
        $this->numero();
    }

    public function paginate()
    {
        $page = (int)$_GET["page"];
        $count = $this->m_plateforme->transactionCount();
        $nbrePage = ceil($count / PlateformeModel::LIMIT);
        $offset = ($page - 1) * PlateformeModel::LIMIT;

        $histories = $this->m_plateforme->history($offset);
        $this->load->view("admin/components/list_transaction", [
            "histories" => $histories,
            "pagination" => $count > PlateformeModel::LIMIT,
            "page" => $page,
            "nbrePage" => $nbrePage,
        ]);
    }

    public function retrait()
    {
        $comptes = $this->m_numero->findAll();
        $this->load->view("admin/components/form_plateforme_retrait", [
            "comptes" => $comptes,
        ]);
    }
    public function runRetrait()
    {
        $comptes = $this->m_numero->findAll();
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("numero","numero","required", [
            "required" => "Selectionner une compte"
        ]);
        $this->form_validation->set_rules("montant","montant","required", [
            "required" => "Indiquer le montant à retirer"
        ]);
        if(!$this->form_validation->run())
        {
            ob_start();
            $this->load->view("admin/components/form_plateforme_retrait", [
                "comptes" => $comptes,
                "post" => (object)$_POST,
            ]);
            $content = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $content
            ]); 
            exit();
        }
        $montant = (int)$_POST["montant"];
        $numero = (int)$_POST["numero"];
        if($montant <= 0)
        {
            ob_start();
            $this->compte();
            $content = ob_get_clean();
            echo json_encode([
                "success" => true,
                "page" => $content
            ]);
            exit();
        }
        $compte = $this->m_plateforme->get();
        if($montant > (int)$compte->soldes)
        {
            ob_start();
            $this->load->view("admin/components/form_plateforme_retrait", [
                "comptes" => $comptes,
                "post" => (object)$_POST,
                "soldeError" => true,
            ]);
            $content = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $content,
            ]); 
            exit();
        }

        $client = $this->m_numero->findById($numero);
        $response = $this->deposit($client, $montant);

        if($response["error"])
        {
            ob_start();
            $this->load->view("admin/components/form_plateforme_retrait", [
                "comptes" => $comptes,
                "post" => (object)$_POST,
                "apiError" => $response["transaction"]["statusMessage"],
            ]);
            $content = ob_get_clean();
            echo json_encode([
                "success" => false,
                "page" => $content,
            ]); 
            exit();
        }

        $this->m_plateforme->updateSolde(-1 * $montant);
        $this->m_plateforme->updateNbreRetrait();
        $this->m_plateforme->insert(["montant","motif"],[$montant,"retrait"]);

        ob_start();
        $this->compte();
        $content = ob_get_clean();
        echo json_encode([
            "success" => true,
            "page" => $content
        ]);
    }

    public function deposit($client, $montant)
    {
         /**
         * Connexion aux API de paiement ici
         * 
         */
        $momo = new Momo();
		$momo->setApiKey(API_KEY);

		$transaction = $momo
		->deposit()
		->amount($montant)
		->currency("XOF")
		->to(str_replace("+","",$client->numero)) // Sender phone number with country code préfix
		->create();
		
		$status = $transaction->getStatus();
        $response = null;

        if ($status != "pending") {
            return [
                "pending" => false,
                "error" => true,
                "success" => false,
                "transaction" => $transaction->getArray(),
                "nopending" => true,
			];
		}

        do {
			$transaction = $momo->getStatus($transaction->getReference());
			$status = $transaction->getStatus();
			if ($status == "error") {
				$response = [
					"pending" => false,
					"error" => true,
					"success" => false,
					"transaction" => $transaction->getArray()
				];
			} else if ($status == "success") {
				$response = [
					"pending" => false,
					"error" => false,
					"success" => true,
					"transaction" => $transaction->getArray(),
				];
			} else {
				$response = [
					"pending" => true,
					"error" => false,
					"success" => false,
					"transaction" => $transaction->getArray(),
				];
			}
		} while ($response["pending"] == true);

        return $response;
    }
}