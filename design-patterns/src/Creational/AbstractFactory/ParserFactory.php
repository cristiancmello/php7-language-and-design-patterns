<?php

namespace DesignPatterns\Creational\AbstractFactory;

class ParserFactory
{
    public function createJsonParser(): JsonParser
    {
        return new JsonParser();
    }

    public function createCvsParser(bool $skipHeaderLine): CsvParser
    {
        return new CsvParser($skipHeaderLine);
    }

    public function createMarkdownParse(bool $htmlOutput): MarkdownParser
    {
        return new MarkdownParser($htmlOutput);
    }
}