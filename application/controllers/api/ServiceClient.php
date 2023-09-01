<?php

class ServiceClient extends APIController {

    private $folder;

    public function __construct()
    {
        parent::__construct();
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "piece_jointe" . DIRECTORY_SEPARATOR;
        $this->load->model("ServiceClientModel","m_service");
        $this->load->model("MessagesModel","m_message");
        $this->load->model("UserModel","m_user");
        $this->load->model("OffreModel","m_offre");
        $this->load->model("NotificationOffreModel", "m_notif");
        $this->load->model("HistoriqueOffreModel","m_history");
    }

    public function getAll()
    {
        $lists = $this->m_service->findAllByUser($this->session->userdata('userId'));
        echo json_encode([
            'lists' => $lists
        ]);
    }

    public function add($type)
    {
        $id_user = $this->session->userdata("userId");
        $numero = $this->m_service->generateNumero($type);
        $objet = trim($_POST["objet"]);
        $id_offre = (int)filter_var($_POST["ref"], FILTER_SANITIZE_NUMBER_INT);
        $idVendeur = (int)$_POST["idVendeur"];
        $message = trim($_POST["message"]);

        if($idVendeur <= 0)
        {
            $idVendeur = null;
        }
        if($id_offre <= 0)
        {
            $id_offre = null;
        }

        $id_service = $this->m_service->insert(["id_user","numero","type","objet","id_offre","id_vendeur","created_at"],[
            $id_user,$numero,$type,$objet,$id_offre,$idVendeur,date('Y-m-d H:i:s')
        ]);

        if($type === 'litige')
        {
            $idNotif = (int)$_POST["idNotif"];
            $this->m_notif->update(["is_read"],[1,$idNotif]);
            
            $this->load->model('OffreModel', 'm_offre');
            $this->m_offre->update(["etat"], [Offre::LITIGE, $id_offre]);
        }

        /**
         * Creation conversation entre admin/user
         */
        $piece_jointe = null;
        if(!empty($_FILES))
        {
            $file = $_FILES["photo"];
            $ext = pathinfo($file["name"],PATHINFO_EXTENSION);
            $piece_jointe = "pj-" . time() . "." . $ext;
            move_uploaded_file($file["tmp_name"],$this->folder . $piece_jointe);
        }
        $this->m_message->insert(["id_user","id_service","message","piece_jointe","sender"],[
            $id_user,$id_service,$message,$piece_jointe,"user"
        ]);
        
        if($idVendeur)
        {
            $user = $this->m_user->findOneBy(["id" => $id_user]);
            $offre = $this->m_offre->findOneBy(["id" => $id_offre]);
            $date = now();
            $body = sprintf("%s a lancé un litige sur l'offre %s", $user->pseudo, getOffreReference($offre->id));
            $id_notif_offre = $this->m_notif->insert(["id_offre","id_user","created_at"],[$id_offre,$idVendeur,$date]);
            $this->m_history->insert(["id_notification_offre","etat","montant","message","created_at"],[$id_notif_offre, Offre::LITIGE,$offre->montant,$body,$date]);
            
            $this->sendNotification($idVendeur, "Litige", $body);
        }
        echo json_encode(["success" => true]);
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
}