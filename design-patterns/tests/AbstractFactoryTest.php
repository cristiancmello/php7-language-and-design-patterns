<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Creational\AbstractFactory\ParserFactory;
use DesignPatterns\Creational\AbstractFactory\JsonParser;
use DesignPatterns\Creational\AbstractFactory\CsvParser;
use DesignPatterns\Creational\AbstractFactory\MarkdownParser;

class AbstractFactoryTest extends TestCase
{
    // IMPORTANTE: NÃO NOS INTERESSA, NO PRIMEIRO MOMENTO, VERIFICAR FUNCIONALIDADES. O FOCO
    // É APENAS SE O ABSTRACT FACTORY CONSEGUE CRIAR A INSTÂNCIA DA CLASSE CONCRETA

    // Teste que verifica se Parser de Json pode ser criado
    public function testCanCreateJsonParser()
    {
        $factory = new ParserFactory();
        $parser = $factory->createJsonParser();

        // A classe da instância $parser é equivalente a classe JsonParser? Faça a asserção
        $this->assertInstanceOf(JsonParser::class, $parser);
    }

    public function testCanCreateCsvParser()
    {
        $factory = new ParserFactory();
        $parser = $factory->createCsvParser(CsvParser::OPTION_CONTAINS_HEADER);

        $this->assertInstanceOf(CsvParser::class, $parser);
    }

    public function testCanCreateMarkdownParser()
    {
        $factory = new ParserFactory();
        $parser = $factory->createMarkdownParse(true);

        $this->assertInstanceOf(MarkdownParser::class, $parser);
    }

    // Um teste para explorar funcionalidade simples
    public function testCanHtmlReadableMarkdownParser()
    {
        $factory = new ParserFactory();
        $parser = $factory->createMarkdownParse(true);
        $htmlOutput = $parser->parse("#Hello")[0];

        $this->assertEquals('<h1>Hello</h1>', $htmlOutput);
    }
}
