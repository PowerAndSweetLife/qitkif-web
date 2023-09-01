<?php

class Messenger extends AdminController {

    private $folder;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MessagesModel","m_message");
        $this->load->model("ServiceClientModel","m_service");
        $this->load->model("UserModel","m_user");
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "piece_jointe" . DIRECTORY_SEPARATOR;
    }

    public function index()
    {
        $litiges = $this->m_service->findBy(["type" => "litige"]);
        foreach($litiges as $k => $litige)
        {
            $litiges[$k]->user = $this->m_user->findOneBy(["id" => $litige->id_user]);
        }
        
        $assists = $this->m_service->findBy(["type" => "ticket"]);
        foreach($assists as $k => $assist)
        {
            $assists[$k]->user = $this->m_user->findOneBy(["id" => $assist->id_user]);
        }

        $last = $this->m_message->findLastBy(["sender" => "user"]);
        $messages = [];
        $service = null;
        if($last)
        {
            $this->m_message->markAsReadByAdmin($last->id_service);
            $messages = $this->m_message->findBy(["id_service" => $last->id_service]);
            $service = $this->m_service->findOneBy(["id" => $last->id_service]);
            
            $service->acheteur = $this->m_user->findOneBy(["id" => $service->id_user]);
            $service->vendeur = $this->m_user->findOneBy(["id" => $service->id_vendeur]);
        }

        $this->load->view('admin/messenger_page',[
            "litiges" => $litiges,
            "assists" => $assists,
            "messages" => $messages,
            "service" => $service,
        ]);
    }

    public function get()
    {
        $idService = (int)$_GET["id"];
        $idUser = null;
        $service = $this->m_service->findOneBy(["id" => $idService]);
        $messages = [];

        if((int)$service->start_by_admin === 0)
        {
            if(array_key_exists("idUser", $_GET))
            {
                $idUser = (int)$_GET["idUser"];
            }
            if($idUser)
            {
                $messages = $this->m_message->findBy(["id_service" => $idService, "id_user" => $idUser]);
            }
            else
            {
                $messages = $this->m_message->findBy(["id_service" => $idService]);
            }
            
            $service->acheteur = $this->m_user->findOneBy(["id" => $service->id_user]);
            $service->vendeur = $this->m_user->findOneBy(["id" => $service->id_vendeur]);
            
            if($idUser)
            {
                if($idUser === (int)$service->id_user)
                {
                    $service->_sender = $service->acheteur;
                }
                else
                {
                    $service->_sender = $service->vendeur;
                }
                
            }
            else
            {
                $service->_sender = $service->acheteur;
            }
        }
        else
        {
            $messages = $this->m_message->listStartByAdmin($idService);
        }

        $this->m_message->markAsReadByAdmin($idService);


        $this->load->view('admin/messenger_page',[
            "messages" => $messages,
            "service" => $service,
            "idUser" => $idUser ? $idUser : $service->id_user
        ]);
    }
    public function getContent()
    {
        $idService = (int)$_GET["id"];
        $data = $this->m_message->findBy(["id_service" => $idService]);
        $service = $this->m_service->findOneBy(["id" => $idService]);

        $service->acheteur = $this->m_user->findOneBy(["id" => $service->id_user]);
        $service->vendeur = $this->m_user->findOneBy(["id" => $service->id_vendeur]);

        $this->m_message->markAsReadByAdmin($idService);

        // $page = "admin/messenger";
        // if(isset($_GET["page"]))
        // {
        $page = "admin/components/messenger_content";
        //}
        $this->load->view($page ,["messages" => $data, "service" => $service]);
    }
    public function getLast()
    {
        $idService = (int)$_GET["idService"];
        $data = $this->m_message->findLastBy(["id_service" => $idService]);
        echo json_encode($data);
    }
    public function send()
    {
        $message = trim($_POST["message"]) !== "" ? trim($_POST["message"]) : null;
        $file = $_FILES["piece-jointe"];
        if($file['size'] <= 0) 
        {
            $file = null;
        }
        if(is_null($message) && is_null($file))
        {
            exit();
        }

        $piece_jointe  = null;
        $id_user = (int)$_POST["id-user"];
        $id_service = (int)$_POST["id-service"];
        if($file)
        {
            $ext = pathinfo($file["name"],PATHINFO_EXTENSION);
            $piece_jointe = "pj-" . time() . "." . $ext;
            move_uploaded_file($file["tmp_name"],$this->folder . $piece_jointe);
        }
        
        $date_ = now();

        if($id_user !== 0)
        {
            $this->m_message->insert(["id_user","id_service","message","piece_jointe","sender","read_by_admin","date_"],[
                $id_user,$id_service,$message,$piece_jointe,"admin",1,$date_
            ]);
        }
        else
        {
            $this->m_message->insert(["id_service","message","piece_jointe","sender","read_by_admin","date_"],[
                $id_service,$message,$piece_jointe,"admin",1,$date_
            ]);
        }
        

        echo json_encode([
            "success" => true,
            "to" => $id_user,
            "idService" => $id_service,
            "message" => $message,
            "pieceJointe" => $piece_jointe,
            "date_" => datetimeFormat($date_)
        ]);
    }
    public function getUnreadCount()
    {
        echo json_encode([
            "count" => $this->m_message->unreadCountBy(["read_by_admin" => 0]),
        ]);
    }

    public function markAsRead()
    {
        $idService = (int)$_POST["idService"];
        $this->m_message->markAsReadByAdmin($idService);
    }

    public function getPageToRender()
    {
        $lastNotRead = $this->m_message->findLast(["read_by_admin" => 0]);
        $page = "assist";
        if($lastNotRead)
        {
            $service = $this->m_service->findOneBy(["id" => $lastNotRead->id_service]);

        
            if($service->type === "litige")
            {
                $page = "litige";
            }
        }
        
        echo json_encode(["page" => $page]);
    }
}