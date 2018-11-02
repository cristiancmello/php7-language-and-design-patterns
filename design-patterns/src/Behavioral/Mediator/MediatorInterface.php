<?php

namespace DesignPatterns\Structural\Mediator;

interface MediatorInterface
{
    /**
     * @param string $content
     */
    public function sendResponse($content);

    public function makeRequest();

    public function queryDb();
}
