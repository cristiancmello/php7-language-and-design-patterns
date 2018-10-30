<?php

namespace DesignPatterns\Creational\StaticFactory;

final class StaticFactory
{
    public static function factory(string $type): FormatterInterface
    {
        switch ($type) {
            case 'string':
                return new FormatString();
            case 'number':
                return new FormatNumber();
            default:
                throw new \InvalidArgumentException('Unknown format given');
        }
    }
}