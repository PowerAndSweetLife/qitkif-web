<?php

class Paiement extends APIController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("OffreModel","m_offre");
        $this->load->model("NotificationOffreModel","m_notif");
        $this->load->model("HistoriqueOffreModel","m_history");
        $this->load->model("UserModel","m_user");
        $this->load->model("NumeroPaiementModel","m_numero");
        $this->load->model("TransactionModel","m_transaction");
        $this->load->model("PaiementUserModel","pay_user");
        $this->load->model("PlateformeModel","m_plateforme");
        $this->load->model("SettingModel","m_setting");
    }

    public function run() 
    {
        $code = $_POST['code'];
        $idUser = $this->session->userdata("userId");
        $user = $this->m_user->findOneBy(["id" => $idUser]);

        if(!password_verify($code,$user->code))
        {
            echo json_encode(["passwordError" => true,"success" => false]);
            exit();
        }

        $montant = (int)nospace($_POST["montant"]);
        // $timbre = (int)nospace($_POST["timbre"]);
        $frais = (int)nospace($_POST['frais']);
        $commission = (int)nospace($_POST["commission"]);
        $idNumero = (int)$_POST["idNumero"];
        $numero = $this->m_numero->findOneBy(["id" => $idNumero]);
       
        // $toPay = $montant + $timbre + $frais + $commission;
        $toPay = $montant + $frais + $commission;
        $response = $this->collect($numero, $toPay);

        if($response["error"])
        {
            echo json_encode($response);
            exit();
        }


        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];

        $this->m_offre->update(["etat","updated_at"],[Offre::PAY_SUCCESS,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(['id_notification_offre','etat','montant','created_at'],[$new_notif,Offre::PAY_SUCCESS,$montant,now()]);

        $this->pay_user->insert(["id_user","id_client","id_offre","montant","frais","date_"], [$idUser, $idClient, $idOffre, $montant, $frais,now()]);
        $this->m_transaction->insert(["id_user","id_offre","montant","motif","date_"],[$idUser,$idOffre,$toPay,"achat",now()]);

        $firebase = new FirebaseAdmin();
        $devices = $this->m_notif->getDevicesUser($idClient);
        foreach($devices as $device)
        {
            $firebase->createCloudMessage($device->token_device,"Paiement effectué",$user->pseudo . " a effectué le paiement! Vous devez preparer la commande.");
        }
        
        $this->m_plateforme->updateSolde($commission);
        $this->m_plateforme->updateNbreCommission();
        $this->m_plateforme->insert(["id_user","id_offre","montant","motif"], [$idUser, $idOffre,$commission, "achat"]);
        
        echo json_encode($response);

    }
    public function retrait()
    {
        $idNumero = (int)$_POST["idNumero"];
        $numero = $this->m_numero->findOneBy(["id" => $idNumero]);
        $montant = (int)nospace($_POST["montant"]);
        $idUser = $this->session->userdata("userId");
        $user = $this->m_user->findOneBy(["id" => $idUser]);

        if((int)$user->soldes < $montant)
        {
            echo json_encode([
                "success" => false,
                "insuffisant" => true
            ]);
            
            exit();
        }

        $response = $this->deposit($numero, $montant);

        if($response["error"])
        {
            echo json_encode($response);
            exit();
        }

        
        $this->m_user->retrait($montant, $idUser);
        $this->m_transaction->insert(["id_user","montant","motif","date_"],[$idUser,$montant,"retrait",now()]);

        echo json_encode(["success" => true, "time" => time()]);

    }

    public function getConfig()
    {
        $config = $this->m_setting->findById(1);

        echo json_encode($config);
    }

    private function deposit($client, $montant)
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

    private function collect($client, $montant)
    {
        /**
         * Connexion aux API de paiement ici
         * 
         */
        $momo = new Momo();
		$momo->setApiKey(API_KEY);

		$transaction = $momo
		->collect()
		->amount($montant)
		->currency("XOF")
		->from(str_replace("+","",$client->numero)) // Sender phone number with country code préfix
		->firstName($client->firstname_proprietaire) // First name of the sender
		->lastName($client->lastname_proprietaire)
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