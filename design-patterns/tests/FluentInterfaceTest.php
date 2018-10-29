<?php

use PHPUnit\Framework\TestCase;

use DesignPatterns\Structural\FluentInterface\Sql;

class FluentInterfaceTest extends TestCase
{
    public function testBuildSql()
    {
        $query = (new Sql())
            ->select(['foo', 'bar'])
            ->from('foobar', 'f')
            ->where('f.bar = ?');

        $this->assertEquals('SELECT foo, bar FROM foobar AS f WHERE f.bar = ?', (string) $query);
    }
}