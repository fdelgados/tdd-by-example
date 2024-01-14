<?php

declare(strict_types=1);

namespace TddByExample;

final class Bank
{
    private array $rates;

    public function __construct()
    {
        $this->rates = [];
    }

    public function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($this, $to);
    }

    public function rate(string $from, string $to): int
    {
        if ($from === $to) {
            return 1;
        }

        return $this->rates[(string) new Pair($from, $to)];
    }

    public function addRate(string $from, string $to, int $rate): void
    {
        $this->rates[(string) new Pair($from, $to)] = $rate;
    }
}
