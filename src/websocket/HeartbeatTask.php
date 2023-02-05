<?php

/**
 * Author: WoozyDev
 */

namespace websocket;

use ElephantIO\Client;
use pocketmine\scheduler\Task;

// this task is for the connection to stay alive.
class HeartbeatTask extends Task
{
    private Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function onRun(): void
    {
        $this->client->emit("heartbeat", [1]);
    }

}