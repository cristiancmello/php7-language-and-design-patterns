<?php

namespace DesignPatterns\Structural\Mediator;

class Mediator implements MediatorInterface
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var Database
     */
    private $database;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Database $database, Client $client, Server $server)
    {
        $this->database = $database;
        $this->client = $client;
        $this->server = $server;

        $this->database->setMediator($this);
        $this->client->setMediator($this);
        $this->server->setMediator($this);
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function sendResponse($content)
    {
        $this->client->output($content);
    }

    public function queryDb(): string
    {
        return $this->database->getData();
    }
}