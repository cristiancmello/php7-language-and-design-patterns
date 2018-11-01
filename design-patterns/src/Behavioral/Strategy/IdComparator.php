<?php

namespace DesignPatterns\Behavioral\Strategy;

class IdComparator implements ComparatorInterface
{
    public function compare($a, $b): int
    {
        return $a['id'] <=> $b['id'];
    }
}