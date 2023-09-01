<?php

class Offre extends APIController {

    // const WAIT_VALIDATION = 0;
    // const WAIT_VALIDATION_CONTRE = 1;
    // const ACCEPTED = 2;
    // const PAIEMENT = 3;
    // const PREPARE_CMD = 4;
    // const LIVRAISON = 5;
    // const CANCEL = 6;
    // const CLOSE = 7;
    // const LITIGE = 8;

    const WAIT_VALIDATION = 100;

    const WAIT_VALIDATION_CONTRE = 110;

    const ACCEPTED = 200;

    const ACCEPTED_AND_PAY_ACTIVE = 250;

    const PAY_ACTIVE = 300;

    const PAY_SUCCESS = 310;

    const PREPARATION = 400;

    const LIVRAISON = 500;

    const CLOSE_SUCCESS = 600;

    const CLOSE_NOT_SUCCESS = 610;

    const LITIGE = 700;

    const STATES = [
        self::WAIT_VALIDATION => "En attente de validation",
        self::WAIT_VALIDATION_CONTRE => "En attente de validation",
        self::ACCEPTED => "Offre accepté",
        self::ACCEPTED_AND_PAY_ACTIVE => "Paiement en attente",
        self::PAY_ACTIVE => "Paiement en attente",
        self::PREPARATION => "En Preparation",
        self::LIVRAISON => "Livraison",
        self::CLOSE_SUCCESS => "Cloturé",
        self::CLOSE_NOT_SUCCESS => "Annuler",
        self::LITIGE => "Litige"
    ];

    protected $user;
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model("OffreModel","m_offre");
        $this->load->model("NotificationOffreModel","m_notif");
        $this->load->model("HistoriqueOffreModel","m_history");
        $this->load->model("UserModel","m_user");
        $this->load->model("TransactionModel","m_transaction");
        // $this->load->model("PaiementVendeurModel","pay_vendeur");
        $this->load->model("PaiementUserModel","pay_user");
        $this->load->model("PlateformeModel","m_plateforme");
        $this->load->model("SettingModel","m_setting");

        $this->user = $this->m_user->findOneBy(["id" => $this->session->userdata("userId")]);
    }

    public function create($type)
    {
        $id_acheteur = null;
        $id_vendeur = null;
        $user_to_notify = null;
        $bodyNotif = null;
        $titleNotif = null;
        if($type === 'achat')
        {
            $id_acheteur = $this->session->userdata("userId");
            $id_vendeur = (int)$_POST['id_vendeur'];
            $user_to_notify = $id_vendeur;
            
            $titleNotif = "Proposition d'achat";
            $acheteur = $this->m_user->findOneBy(["id"=>$id_acheteur]);
            $bodyNotif = $acheteur->pseudo . " vous a envoyé une proposition d'achat";
        }
        else if($type === 'vente')
        {
            $id_acheteur = (int)$_POST['id_acheteur'];
            $id_vendeur = $this->session->userdata("userId");
            $user_to_notify = $id_acheteur;

            $titleNotif = "Proposition de vente";
            $vendeur = $this->m_user->findOneBy(["id"=>$id_vendeur]);
            $bodyNotif = $vendeur->pseudo . " vous a envoyé une proposition de vente";
        }
        else
        {
            echo json_encode(["success" => false]);
            exit();
        }

        $montant = (int)nospace($_POST['montant']);
        $mode_remise = trim($_POST['mode_remise']);
        $id_categorie = (int)$_POST['id_categorie'];
        $nom_objet = trim($_POST['nom_objet']);
        $message = isset($_POST["message"]) ? trim($_POST['message']) : null;
        $etat = self::WAIT_VALIDATION;
        $date = now();

        $id_offre = $this->m_offre->insert(["id_acheteur","id_vendeur","montant","id_categorie","nom_objet","mode_remise","etat","action","updated_at"],
                [$id_acheteur,$id_vendeur,$montant,$id_categorie,$nom_objet,$mode_remise,$etat,$type,$date]);
        $id_notif_offre = $this->m_notif->insert(["id_offre","id_user","created_at"],[$id_offre,$user_to_notify,$date]);
        $this->m_history->insert(["id_notification_offre","etat","montant","message","created_at"],[$id_notif_offre,$etat,$montant,$message,$date]);

        $this->sendNotification($user_to_notify, $titleNotif, $bodyNotif);

        post(nodeUrl("offreObserver"), ["idOffre" => $id_offre, "state" => self::WAIT_VALIDATION, "action" => "wait_validation"]);

        echo json_encode(["success" => true]);
    }

    public function history()
    {
        $userId = (int)$this->session->userdata('userId');
        $data = $this->m_offre->findAllCancelOrCloseByUserId($userId);
        
        $data_2 = [];
        foreach($data as $key => $value)
        {
            $dt = new DateTime($value->updated_at);
            $date = $dt->format('d/m/Y');

            $clientId = ($userId === (int)$value->id_acheteur) ? (int)$value->id_vendeur : (int)$value->id_acheteur;
            $data[$key]->client = $this->m_user->findOneBy(['id' => $clientId]);
            $data[$key]->acheteur = $this->m_user->findOneBy(['id' => $value->id_acheteur]);
            $data[$key]->vendeur = $this->m_user->findOneBy(['id' => $value->id_vendeur]);
            $data[$key]->ref = getOffreReference($value->id);

            $data_2[$date][] = $value;
        }

        $responses = [];
        foreach($data_2 as $key => $value)
        {
            $responses[] = [
                "date" => $key,
                "data" => $value,
            ];
        }

        echo json_encode([
            'histories' => $responses,
            'states' => self::STATES
        ]);
    }
    public function inprogress()
    {
        $userId = (int)$this->session->userdata('userId');
        $data = $this->m_offre->findAllInProgressByUserId($userId);
        
        $data_2 = [];
        foreach($data as $key => $value)
        {
            $dt = new DateTime($value->updated_at);
            $date = $dt->format('d/m/Y');

            $clientId = ($userId === (int)$value->id_acheteur) ? (int)$value->id_vendeur : (int)$value->id_acheteur;
            
            $ref = getOffreReference($value->id);
            $data[$key]->client = $this->m_user->findOneBy(['id' => $clientId]);
            $data[$key]->acheteur = $this->m_user->findOneBy(['id' => $value->id_acheteur]);
            $data[$key]->vendeur = $this->m_user->findOneBy(['id' => $value->id_vendeur]);
            $data[$key]->ref = $ref;

            $data_2[$date][] = $value;
        }

        $responses = [];
        foreach($data_2 as $key => $value)
        {
            $responses[] = [
                "date" => $key,
                "data" => $value,
            ];
        }

        echo json_encode([
            'lists' => $responses,
            'states' => self::STATES
        ]);
    }

    public function accept()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];
        $montant = (int)nospace($_POST["montant"]);

        $offre = $this->m_offre->findOneBy(["id" => $idOffre]);
        $currentState = (int)$offre->etat;
        $nextState = -1;

        if($offre->action === 'achat')
        {
            if($currentState === self::WAIT_VALIDATION)
            {
                $nextState = self::ACCEPTED_AND_PAY_ACTIVE;
                post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => $nextState, "action" => "paiement"]);
            }
            else if($currentState === self::WAIT_VALIDATION_CONTRE)
            {
                $nextState = self::ACCEPTED;
                post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => $nextState, "action" => "active_paiement"]);
            }
        }
        else
        {
            if($currentState === self::WAIT_VALIDATION)
            {
                $nextState = self::ACCEPTED;
                post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => $nextState, "action" => "active_paiement"]);
            }
            else if($currentState === self::WAIT_VALIDATION_CONTRE)
            {
                $nextState = self::ACCEPTED_AND_PAY_ACTIVE;
                post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => $nextState, "action" => "paiement"]);
            }
        }

        $this->m_offre->update(["etat","updated_at"],[$nextState,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,$nextState,$montant,now()]);

        
        $this->sendNotification($idClient, "Proposition accepté", $this->user->pseudo . " a accepté votre proposition");

        echo json_encode(["success" => true]);
    }
    public function reject()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];
        $montant = (int)nospace($_POST["montant"]);

        $observation = json_encode([
            "state" => "rejected",
            "user_cancel" => $this->session->userdata('userId')
        ]);
        $this->m_offre->update(["etat", "rejected", "observation","updated_at"],[self::CLOSE_NOT_SUCCESS, 1, $observation,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CLOSE_NOT_SUCCESS,$montant,now()]);

        $user = $this->m_user->findOneBy(["id" => $this->session->userdata("userId")]);
        $this->sendNotification($idClient, "Proposition rejeté", $user->pseudo . " a rejeté votre proposition");
        echo json_encode(["success" => true]);
    }
    
    public function activatePaiement()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];
        $montant = (int)nospace($_POST["montant"]);

        $this->m_offre->update(["etat","updated_at"],[self::PAY_ACTIVE,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::PAY_ACTIVE,$montant,now()]);

        $user = $this->m_user->findOneBy(["id" => $this->session->userdata("userId")]);
        $this->sendNotification($idClient, "Paiement activé", $user->pseudo . " a activé le paiement");

        /**
         * On lance le compte à rebour en background
         */
        post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => self::PAY_ACTIVE, "action" => "paiement"]);

        echo json_encode(["success" => true]);
    }

    public function livraison()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];
        $duration = (int)$_POST["duration"];
        $justification = trim($_POST["justification"]);

        $currentOffre = $this->m_offre->findOne($idOffre);
        $datePaiement = new Datetime($currentOffre->updated_at);
        $now = new Datetime('now');
        $diff = $now->getTimestamp() - $datePaiement->getTimestamp();
        $diffMinute = ceil($diff / 60);


        if($diffMinute > 30)
        {
            $observation = json_encode([
                "state" => "expired",
            ]);
            $this->m_offre->update(["etat","observation","updated_at"],[self::CLOSE_NOT_SUCCESS, $observation, now(),$idOffre]);
            $this->m_notif->update(["is_read"],[1,$idNotif]);
            $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
            $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CLOSE_NOT_SUCCESS,$currentOffre->montant,now()]);
            
            echo json_encode([
                "success" => false,
                "expired" => true
            ]);
            exit();
        }

        $this->m_offre->update(["etat","updated_at","duree_livraison","justification_livraison"],[self::LIVRAISON,now(),$duration,$justification,$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::LIVRAISON,$currentOffre->montant,now()]);

        $user = $this->m_user->findOneBy(["id" => $this->session->userdata("userId")]);
        $this->sendNotification($idClient,"Mise en livraison", $user->pseudo . " a procédé à la mise en livraison de votre article, Vous recevrer le colis d'ici $duration h");
        
        /**
         * On lance le compte à rebour en background
         */
        post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => self::LIVRAISON, "action" => "livraison", "duration" => $duration]);

        echo json_encode(["success" => true]);
    }

    public function notReceived()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];

        $currentOffre = $this->m_offre->findOne($idOffre);
        $dateDebut = new Datetime($currentOffre->updated_at);
        $now = new Datetime('now');
        $diff = $now->getTimestamp() - $dateDebut->getTimestamp();
        $diffMinute = ceil($diff / 60);

        $dureeLivraison = (int)$currentOffre->duree_livraison;
        if($diffMinute > ($dureeLivraison * 60))
        {
            // $this->m_offre->update(["etat","updated_at"],[self::CANCEL,now(),$idOffre]);
            $this->m_notif->update(["is_read"],[1,$idNotif]);
            // $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
            // $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CANCEL,$currentOffre->montant,now()]);
            echo json_encode([
                "expired" => true,
            ]);
            exit();
        }
        echo json_encode(["expired" => false]);
    }

    public function success()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $offre = $this->m_offre->findOne($idOffre);

        $setting = $this->m_setting->findById(1);

        $paiementUser = $this->pay_user->findOneBy(["id_offre" => $idOffre,"id_user" => $offre->id_acheteur,"id_client" => $offre->id_vendeur]);
        
        $commission = ((int)$paiementUser->montant * (float)$setting->commission_vendeur) / 100;
        // $toPay = (int)$paiementUser->montant + (int)$paiementUser->frais - (int)$setting->commission_vendeur;
        $toPay = (int)$paiementUser->montant + (int)$paiementUser->frais - (int)$commission; // Montant récu par le vendeur

        $this->m_offre->update(["etat","updated_at"],[self::CLOSE_SUCCESS,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);

        $this->m_user->incrementActionCount($offre->id_acheteur, "achat");
        $this->m_user->incrementActionCount($offre->id_vendeur, "vente");
        $this->m_user->deposit( $toPay, $offre->id_vendeur);
        $this->m_transaction->insert(["id_user","id_offre","montant","motif","date_"],[$offre->id_vendeur,$idOffre,$toPay,"vente",now()]);
       
        // $this->m_plateforme->insert(["id_user","id_offre","montant","motif"], [$offre->id_vendeur, $idOffre,(int)$setting->commission_vendeur, "vente"]);
        $this->m_plateforme->insert(["id_user","id_offre","montant","motif"], [$offre->id_vendeur, $idOffre,(int)$commission, "vente"]);
        // $this->m_plateforme->updateSolde((int)$setting->commission_vendeur);
        $this->m_plateforme->updateSolde((int)$commission);
        $this->m_plateforme->updateNbreCommission();
        //$this->pay_vendeur->insert(['id_vendeur','id_acheteur','id_offre','montant'], [$offre->id_vendeur, $offre->id_acheteur,$idOffre,$offre->montant]);
        echo json_encode(["success" => true]);

        /**
         * Créditer le compte du vendeur et de la plateforme
         * 
         */
        payOut($this->m_user->findOneBy(["id" => $offre->id_vendeur]), $toPay);
    }

    public function contreProposition()
    {
        $idOffre = (int)$_POST["idOffre"];
        $idNotif = (int)$_POST["idNotif"];
        $idClient = (int)$_POST["idClient"];
        $montant = (int)nospace($_POST['montant']);
        $modeRemise = trim($_POST['modeRemise']);
        $message = isset($_POST["message"]) ? trim($_POST['message']) : null;

        $this->m_offre->update(["etat","montant","mode_remise","contre","updated_at"],[self::WAIT_VALIDATION_CONTRE,$montant,$modeRemise,1,now(),$idOffre]);
        $this->m_notif->update(["is_read"],[1,$idNotif]);
        $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","message","created_at"],[$id_new_notif,self::WAIT_VALIDATION_CONTRE,$montant,$message,now()]);

        $offre = $this->m_offre->findOne($idOffre);
        $user = $this->m_user->findOneBy(["id" => $this->session->userdata("userId")]);

        $titleNotif = "Contre proposition";
        $bodyNotif = null;
        if($offre->action === "achat")
        {
            $bodyNotif = $user->pseudo . " a envoyé une cotre-proposition d'achat\nVous avez 30 minute pour l'accepter";
        }
        else
        {
            $bodyNotif = $user->pseudo . " a envoyé une cotre-proposition de vente\nVous avez 30 minute pour l'accepter";
        }
        $this->sendNotification($idClient,$titleNotif,$bodyNotif);
        
        /**
         * On lance le compte à rebour en background
         */
        post(nodeUrl("offreObserver"), ["idOffre" => $idOffre, "state" => self::WAIT_VALIDATION_CONTRE, "action" => "contre_proposition"]);
        
        echo json_encode(["success" => true]);
    }

    public function cancel()
    {
        $observation = json_encode([
            "state" => "aborted",
            "user_cancel" => $this->session->userdata('userId')
        ]);

        $idOffre = (int)$_POST["idOffre"];
        $offre = $this->m_offre->findOne($idOffre);
        $idUser = (int)$this->session->userdata("userId");
        $user = $this->m_user->findOneBy(["id" => $idUser]);

        $idNotif = isset($_POST["idNotif"]) ? (int)$_POST["idNotif"] : null;

        $idClient = 0;
        if((int)$offre->id_acheteur === $idUser)
        {
            $idClient = (int)$offre->id_vendeur;
        }
        else
        {
            $idClient = (int)$offre->id_acheteur;
        }

        if((int)$offre->etat === self::PAY_SUCCESS)
        {
            if($idUser !== (int)$offre->id_vendeur)
            {
                $dateDebut = new Datetime($offre->updated_at);
                $now = new Datetime('now');
                $diff = $now->getTimestamp() - $dateDebut->getTimestamp();
                $diffMinute = ceil($diff / 60);

                if($diffMinute < 30)
                {
                    echo json_encode([
                        "success" => false,
                        "message" => "La durée de préparation n'est pas encore ecoulé"
                    ]);
                    exit();
                }
            }
            
            
            $this->m_offre->update(["etat","observation","updated_at"],[self::CLOSE_NOT_SUCCESS, $observation , now(),$idOffre]);
            $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
            $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CLOSE_NOT_SUCCESS,$offre->montant,now()]);
            if($idNotif) 
            {
                $this->m_notif->update(["is_read"],[1,$idNotif]);
            }
            $this->_remboursement($offre->id_acheteur, $offre);
            $this->sendNotification($idClient,"Offre annulé", "{$user->pseudo} a annulé une offre");
            echo json_encode([
                "success" => true
            ]);
        }
        else if((int)$offre->etat === self::LIVRAISON)
        {
            $dateDebut = new Datetime($offre->updated_at);
            $now = new Datetime('now');
            $diff = $now->getTimestamp() - $dateDebut->getTimestamp();
            $diffMinute = ceil($diff / 60);

            $dureeLivraison = (int)$offre->duree_livraison;
            if($diffMinute < ($dureeLivraison * 60))
            {
                echo json_encode([
                    "success" => false,
                    "message" => "La durée de livraison n'est pas encore ecoulé"
                ]);
                exit();
            }
            $this->m_offre->update(["etat",'observation',"updated_at"],[self::CLOSE_NOT_SUCCESS, $observation,now(),$idOffre]);
            $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
            $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CLOSE_NOT_SUCCESS,$offre->montant,now()]);
           
            $this->_remboursement($offre->id_acheteur, $offre);
            $this->sendNotification($idClient,"Offre annulé", "{$user->pseudo} a annulé une offre");
            echo json_encode([
                "success" => true,
            ]);
        }
        else
        {
            $this->m_offre->update(["etat",'observation', "updated_at"],[self::CLOSE_NOT_SUCCESS, $observation,now(),$idOffre]);
            $id_new_notif = $this->m_notif->insert(["id_user","id_offre","created_at"],[$idClient,$idOffre,now()]);
            $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif,self::CLOSE_NOT_SUCCESS,$offre->montant,now()]);
           
            $this->sendNotification($idClient,"Offre annulé", "{$user->pseudo} a annulé une offre");
            echo json_encode([
                "success" => true,
            ]);
        }
    }

    public function getOne($id)
    {
        $idUser = $this->session->userdata("userId");
        $data = $this->m_notif->getLastByOffre($idUser,$id);
        $offre = $this->m_offre->findOne((int)$id);

        $clientId = 0;
        if((int)$offre->id_acheteur === (int)$data->id_user)
        {
            $clientId = $offre->id_vendeur;
        }
        else
        {
            $clientId = $offre->id_acheteur;
        }
        $data->montant = $offre->montant;
        $data->client = $this->m_user->findOneBy(["id" => $clientId]);
        $data->ref = getOffreReference($offre->id);
        $data->offre = $offre;
        echo json_encode($data);
    }

    public function selectOffre()
    {
        echo json_encode($this->m_offre->selectOffre($this->session->userdata("userId")));
    }

    private function sendNotification($clientId,$title,$body)
    {
        $devices = $this->m_notif->getDevicesUser($clientId);
        $firebase = new FirebaseAdmin();

        foreach($devices as $device)
        {
            $firebase->createCloudMessage($device->token_device,$title,$body);
        }
        
    }
    private function _remboursement($idUser, $offre)
    {
        $this->m_user->deposit($offre->montant, $idUser);
        $this->m_transaction->insert(["id_user","id_offre","montant","motif","date_"], [$idUser,$offre->id,$offre->montant,"remboursement",now()]);
    }
}