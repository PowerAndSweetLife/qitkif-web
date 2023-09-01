<?php

class Messages extends APIController {

    private $folder;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MessagesModel",'m_message');
        $this->load->model("ServiceClientModel","m_service");
        $this->folder = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "piece_jointe" . DIRECTORY_SEPARATOR;
    }

    public function get($idService)
    {
        $id_user = $this->session->userdata("userId");
        $this->m_message->markAsReadByUser($idService, $id_user);
        echo json_encode($this->_getList($idService));
    }

    public function getLast($idService)
    {
        $id_user = $this->session->userdata("userId");
        $this->m_message->markAsReadByUser($idService, $id_user);
        echo json_encode($this->_getLast($idService));
    }

    public function add()
    {
        $id_user = $this->session->userdata("userId");
        $id_service = (int)$_POST["idService"];
        $message = trim($_POST["message"]);
        if($message === "")
        {
            $message = null;
        }
        $piece_jointe = null;
        if(!empty($_FILES))
        {
            $file = $_FILES["photo"];
            $ext = pathinfo($file["name"],PATHINFO_EXTENSION);
            $piece_jointe = "pj-" . time() . "." . $ext;
            move_uploaded_file($file["tmp_name"],$this->folder . $piece_jointe);
        }
        $service = $this->m_service->findOneBy(['id' => $id_service]);
        if((int)$service->start_by_admin)
        {
            $this->m_message->insert(["id_user","id_service","message","piece_jointe","sender","read_by_user","date_"],[
                $id_user, $id_service,$message,$piece_jointe,"user",json_encode([$id_user]),now()
            ]);
        }
        else
        {
            $this->m_message->insert(["id_user","id_service","message","piece_jointe","sender","read_by_user","date_"],[
                $id_user,$id_service,$message,$piece_jointe,"user",1,now()
            ]);
        }
        
        $data = $this->_getLast($id_service);
        echo json_encode(["success" => true, "last" => $data,"idService" => $id_service]);
    }

    private function _getList($idService)
    {
        $idUser = $this->session->userdata("userId");
        $service = $this->m_service->findOneBy(['id' => $idService]);
        if((int)$service->start_by_admin)
        {
            $data = $this->m_message->findStartByAdmin($idService);
        }
        else
        {
            $data = $this->m_message->findBy(["id_user" => $idUser, "id_service" => $idService]);
        }
        foreach ($data as $key => $value) 
        {
            $ratio_image = null;
            if($value->piece_jointe)
            {
                $image_size = getimagesize(base_url("public/piece_jointe/" . $value->piece_jointe));
                $ratio_image = $image_size[0] / $image_size[1];
            }

           $data[$key]->ratioImage = $ratio_image;
        }
        return $data;
    }
    private function _getLast($idService)
    {
        $idUser = $this->session->userdata("userId");
        $last = $this->m_message->findLastBy(["id_user" => $idUser, "id_service" => $idService]);
        
        $ratio_image = null;
        if($last->piece_jointe)
        {
            $image_size = getimagesize(base_url("public/piece_jointe/" . $last->piece_jointe));
            $ratio_image = $image_size[0] / $image_size[1];
        }

        $last->ratioImage = $ratio_image;

        return $last;
    }
    
    public function unreadCount()
    {
        $idUser = $this->session->userdata('userId');
        echo json_encode([
            "count" => $this->m_message->unreadCountBy(["read_by_user" => 0, "id_user" => $idUser]),
        ]);
    }
}