<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use FEC\Chat;

require __DIR__ . '/vendor/autoload.php';

$chat = new Chat();

$server = IoServer::factory(
    new HttpServer(new WsServer($chat)), 8081
);

$server->run();