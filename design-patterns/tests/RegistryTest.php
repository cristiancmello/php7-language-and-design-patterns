<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\Registry\Registry;

class RegistryTest extends TestCase
{
    public function testSetAndGetLogger()
    {
        $key = Registry::LOGGER;
        $logger = new stdClass();

        Registry::set($key, $logger);
        $storageLogger = Registry::get($key);

        $this->assertSame($logger, $storageLogger);
        $this->assertInstanceOf(stdClass::class, $storageLogger);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWhenTryingToSetInvalidKey()
    {
        Registry::set('foobar', new stdClass()); // foobar não existe como chave permitida
    }

    /**
     * Um aviso sobre o uso de @runInSeparateProcess: a exceção \InvalidArgumentException pode ser lançada
     * em testes anteriores, como em testThrowsExceptionWhenTryingToSetInvalidKey(), o que pode causar
     * conflito de captura da exceção esperada do teste. Para solucionar isso, podemos executar o teste abaixo
     * num processo PHP independente do processo pai para evitar o conflito. Por este fato que também
     * é recomendável evitar o uso do padrão Registry em favor do padrão Dependency Injection, onde nós
     * podemos injetar uma classe que pode facilmente ser trocada por um mockup.
     *
     * @runInSeparateProcess
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWhenTryingToGetNotSetKey()
    {
        Registry::get(Registry::LOGGER);
    }
}