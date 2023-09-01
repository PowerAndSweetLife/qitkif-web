<?php

class Realtime extends CI_Controller {

    //const TIMEOUT = 60;
    
    public function __construct()
    {
        http_response_code(404);
        exit();
        parent::__construct();
        $this->load->model("MessagesModel","m_message");
        $this->load->model("UserModel","m_user");
        $this->load->model("AdminModel","m_admin");
    }

    public function index()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $userType = trim($_GET['usertype']);
        $messageCount = $this->getUserMessageCount($userType);

        while (true) {
            ob_start();
            // Chaque seconde, on envoie un évènement "ping".
            echo "event: ping\n";
            $curDate = date('d/m/Y H:i:s');
            echo 'data: {"time": "' . $curDate . '"}';
            // Envoi d'un message simple à fréquence aléatoire.
            echo "\n\n";
        
            $count = $this->getUserMessageCount($userType);

            if($messageCount !== $count)
            {
                $last = $this->getLastMessage($userType);
                $last->user = $this->getUser($userType);
                echo 'data: ' . json_encode(["last" => $last]) . "\n\n";
                $messageCount = $count;
            }
        
            // if (!$counter) {
            //   $curDate = date('d/m/Y H:i:s');
            //   echo 'data: ' . json_encode(["time" => $curDate]) . "\n\n";
            //   $counter = rand(1, 10);
            // }
        
            ob_end_flush();
            flush();
        
            // On ferme la boucle si le client a interrompu la connexion
            // (par exemple en fermant la page)
        
            if ( connection_aborted() ) break;
        
            sleep(1);
        }
    }

    public function getUserMessageCount($userType) {
        if($userType === 'user')
        {
            $idUser = (int)$_GET['idUser'];
            $res = $this->m_message->getCountByUser($idUser);
        }
        else
        {
            $res = $this->m_message->getCountByAdmin();
        }
        return $res;
    }
    public function getLastMessage($userType) {
        if($userType === 'user')
        {
            $idUser = (int)$_GET['idUser'];
            return $this->m_message->findLastBy(["id_user" => $idUser]);
           // return DB::customQuery("SELECT * FROM messages WHERE id_user=? ORDER BY id DESC LIMIT 1", [$idUser],false);
        }
        else
        {
            return $this->m_message->findLast();
           // return DB::customQuery("SELECT * FROM messages ORDER BY id DESC LIMIT 1", [],false);
        }
    }
    public function getUser($userType) {
        if($userType === 'user')
        {
            $idUser = (int)$_GET['idUser'];
            return $this->m_user->findOneBy(["id" => $idUser]);
           // return DB::customQuery("SELECT * FROM user WHERE id=? ORDER BY id DESC LIMIT 1", [$idUser],false);
        }
        else
        {
            return $this->m_admin->findOneBy(["id" => 1]);
           // return DB::customQuery("SELECT * FROM `admin` ORDER BY id DESC LIMIT 1", [],false);
        }
    }
}