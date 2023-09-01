<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require_once dirname(dirname(__DIR__)) . "/core/DB.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) 
    {
    }

    public function onMessage(ConnectionInterface $from, $msg) 
    {
        $data = json_decode($msg);
        if($data->type === "register") {
            $from->userId = $data->userId;
            
            if(!$this->clients->offsetExists($from))
            {
                $this->clients->attach($from);
                var_dump("connected... $from->userId");
            }    
        }
        else {
            $this->_send($data->userId,$data);
        }
    }

    public function onClose(ConnectionInterface $conn) 
    {
        echo "\ndisconnected";
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) 
    {
        $conn->close();
    }

    private function _send($from, $msg)
    {
        foreach($this->clients as $client)
        {
            if((int)$client->userId === (int)$msg->to)
            {
                if($msg->type === "message")
                {
                    $sender = \DB::customQuery("SELECT id,pseudo,photo FROM user WHERE id=?", [$from], false);
                    $client->send(json_encode([
                        "type" => "message",
                        "sender" => $sender,
                        "idService" => $msg->idService,
                        "message" => $msg->message ?? null,
                        "pieceJointe" => $msg->pieceJointe ?? null,
                        "date_" => $msg->date_,
                        "to" => (int)$msg->to
                    ]));
                }
                else
                {
                    $client->send(json_encode([
                        "type" => "notification"
                    ]));
                }
            }
        }
    }
}