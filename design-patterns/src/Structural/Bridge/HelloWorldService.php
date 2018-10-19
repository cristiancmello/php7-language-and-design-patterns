<?php

namespace DesignPatterns\Structural\Bridge;

class HelloWorldService extends Service
{
    public function get(string $text)
    {
        return $this->implementation->format($text);
    }
}