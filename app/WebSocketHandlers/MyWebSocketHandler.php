<?php
namespace App\WebSocketHandlers;

use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use BeyondCode\LaravelWebSockets\WebSockets\WebSocketHandler;

class MyWebSocketHandler extends WebSocketHandler
{
    public function onOpen(ConnectionInterface $connection)
    {
        // Handle WebSocket connection opening
        Log::info('WebSocket connection opened');
    }

    public function onClose(ConnectionInterface $connection)
    {
        // Handle WebSocket connection closing
        Log::info('WebSocket connection closed');
    }

    public function onMessage(ConnectionInterface $connection, $payload)
    {
        // Handle incoming WebSocket message
        Log::info('Received WebSocket message: ' . $payload);
        // You can process the received data here
    }}
