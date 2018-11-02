<?php

namespace DesignPatterns\Structural\Bridge;

class HtmlFormatter implements FormatterInterface
{
    public function format(string $text)
    {
        return "<p>$text</p>";
    }
}
