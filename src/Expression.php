<?php

declare(strict_types=1);

namespace TddByExample;

interface Expression
{
    public function reduce(Bank $bank, string $to): Expression;
}
