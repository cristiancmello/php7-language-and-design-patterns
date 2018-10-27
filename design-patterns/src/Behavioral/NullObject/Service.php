<?php

namespace DesignPatterns\Behavioral\NullObject;

class Service
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    /**
     * Service constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->loggerInterface = $logger;
    }

    public function doSomething()
    {
        // Não é necessário verificar se um logger foi criado. Exemplo com uso de `is_null`.
        $this->loggerInterface->log('We are in ' . __METHOD__);
    }
}