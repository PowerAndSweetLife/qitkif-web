<?php
class OffreExpired extends CI_Controller {

    const API_KEY = 'jhK5F743Q61#';

    public function __construct()
    {
        parent::__construct();
        $this->load->model("OffreModel", "m_offre");
        $this->load->model("NotificationOffreModel","m_notif");
        $this->load->model("HistoriqueOffreModel","m_history");
        $this->load->model("UserModel","m_user");
        $this->load->model("TransactionModel","m_transaction");
        $this->load->model("PaiementUserModel","pay_user");
        $this->load->model("PlateformeModel","m_plateforme");
        $this->load->model("SettingModel","m_setting");
    }

    public function index()
    {
        if(!isset($_POST["idOffre"]) || !isset($_POST["key"]))
        {
            http_response_code(403);
            exit();
        }
        if($_POST["key"] !== self::API_KEY)
        {
            http_response_code(403);
            exit();
        }
        $idOffre = (int)$_POST["idOffre"];
        $offre = $this->m_offre->findOneBy(["id" => $idOffre]);
        
        $id_new_notif_acheteur = $this->m_notif->insert(["id_user","id_offre","created_at"],[$offre->id_acheteur,$idOffre,now()]);
        $id_new_notif_vendeur = $this->m_notif->insert(["id_user","id_offre","created_at"],[$offre->id_vendeur,$idOffre,now()]);
        
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif_acheteur,Offre::CLOSE_NOT_SUCCESS,$offre->montant,now()]);
        $this->m_history->insert(["id_notification_offre","etat","montant","created_at"],[$id_new_notif_vendeur,Offre::CLOSE_NOT_SUCCESS,$offre->montant,now()]);
        
        $observation = json_encode([
            "state" => "expired"
        ]);
        $this->m_offre->update(["etat","observation","updated_at"], [Offre::CLOSE_NOT_SUCCESS, $observation, now(), $idOffre]);
        
        if((int)$offre->etat === Offre::LIVRAISON)
        {
            $client = $this->m_user->findOneBy($offre->id_acheteur);
            $this->m_transaction->insert(["id_user","id_offre","montant","motif"], [$offre->id_acheteur,$idOffre,$offre->montant,"remboursement"]);
            payOut($client, $offre->montant);
        }

        $this->_sendNotification($offre->id_acheteur,"Offre expiré", "Delai d'attente dépassé! Cette offre a été annulé");
        $this->_sendNotification($offre->id_vendeur,"Offre expiré", "Delai d'attente dépassé! Cette offre a été annulé");
        
        echo json_encode([
            "success" => true
        ]);
    }

    private function _sendNotification($clientId,$title,$body)
    {
        $devices = $this->m_notif->getDevicesUser($clientId);
        $firebase = new FirebaseAdmin();

        foreach($devices as $device)
        {
            $firebase->createCloudMessage($device->token_device,$title,$body);
        }
        
    }
}