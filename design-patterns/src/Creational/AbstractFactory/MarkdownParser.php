<?php

namespace DesignPatterns\Creational\AbstractFactory;

class MarkdownParser implements Parser
{
    private $htmlOutput;

    public function __construct(bool $htmlOutput)
    {
        $this->htmlOutput = $htmlOutput;
    }

    public function parse(string $input): array
    {
        // Parse somente para reconhecer: "stmt ::= (#+)(" "+) <text>
        // irá retornar um array de <text> encontrado
        $textArray = preg_split('/(#+)(\s*)/', $input);
        $textArrayParsed = array_slice($textArray, 1);

        if ($this->htmlOutput) {
            foreach ($textArrayParsed as &$textParsed) {
                $textParsed = "<h1>$textParsed</h1>";
            }

            unset($textParsed);
        }

        return $textArrayParsed;
    }
}