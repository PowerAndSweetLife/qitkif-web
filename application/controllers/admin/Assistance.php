<?php

class Assistance extends AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ServiceClientModel","m_service");
        $this->load->model("UserModel","m_user");
        $this->load->model("MessagesModel","m_message");
    }

    public function index()
    {
        $this->load->view("admin/assistance", [
            "lists" => $this->getLists()
        ]);
    }

    public function resolved()
    {
        $id = (int)$_POST['id'];

        $this->m_service->update(['closed'],[1,$id]);

        $this->index();
    }

    public function startNew()
    {
        $fieldsError = [];
        $hasError = false;
        $object = trim($this->input->post('object'));
        $message = trim($this->input->post('message'));
        if($object === '')
        {
            $hasError = true;
            $fieldsError[] = "object";
        }
        if($message === '')
        {
            $hasError = true;
            $fieldsError[] = "message";
        }

        if($hasError)
        {
            echo json_encode([
                "success" => false,
                "errors" => $fieldsError
            ]);

            exit();
        }

        $numero = $this->m_service->generateNumero('ticket');
        $noreply = (int)$this->input->post('no-reply');
        $id_service = $this->m_service->insert(["numero","type","objet","created_at", "start_by_admin", "closed"],[
            $numero,'ticket',$object,date('Y-m-d H:i:s'), 1, $noreply
        ]);


        $this->m_message->insert(["id_service","message","sender", "read_by_admin", "read_by_user"],[
            $id_service,$message,"admin", 1, json_encode([])
        ]);

        echo json_encode([
            "success" => true
        ]);
    }

    private function getLists()
    {
        $data = $this->m_service->findBy(["type" => "ticket"]);
        foreach($data as $k => $v)
        {
            $data[$k]->user = $this->m_user->findOneBy(["id" => $v->id_user]);
        }

        return $data;
    }
}