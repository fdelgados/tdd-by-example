<?php

declare(strict_types=1);

namespace TddByExample;

readonly final class Pair implements \Stringable
{
    public function __construct(private string $from, private string $to)
    {
    }

    public function equals(Pair $pair): bool
    {
        return $this->from === $pair->from && $this->to === $pair->to;
    }

    public function __toString(): string
    {
        return sprintf('%s_%s', $this->from, $this->to);
    }
}
