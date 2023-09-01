<?php

//require __DIR__ . '/controllers/api/Chat.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(__DIR__ . '/controllers/api/Chat.php');

$PORT = 9001;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new \Chat()
        )
    ),
    $PORT
);

echo "Websocket running and listen on port $PORT....";

$server->run();

