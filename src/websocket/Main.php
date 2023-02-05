<?php

/**
 * Author: WoozyDev
 */

namespace websocket;

use ElephantIO\Exception\SocketException;
use pocketmine\plugin\PluginBase;
use ElephantIO\Client;

class Main extends PluginBase
{

    protected function onEnable(): void
    {
        try {
            $url = 'http://localhost:8080'; // your websocket server ip
            $client = new Client(Client::engine(Client::CLIENT_4X, $url));
            $client->initialize();
            $client->of('/');
            // check out Elephant.IO github (https://github.com/ElephantIO/elephant.io) for more information on how to use it.
            $this->getScheduler()->scheduleRepeatingTask(new HeartbeatTask($client), 20 * 20 /* (20 seconds) modify the period as you'd like */);
        } catch (SocketException $exception) {
            $this->getLogger()->info("Couldn't connect to websocket server because it's down.");
        }

    }

}