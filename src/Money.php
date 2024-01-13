<?php

declare(strict_types=1);

namespace TddByExample;

class Money implements Expression, \Stringable
{
    public int $amount;
    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function dollar(int $amount): Money
    {
        return new Money($amount, 'USD');
    }

    public static function franc(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }

    public function times(int $multiplier): Money
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    public function plus(Money $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount
            && $this->currency === $money->currency;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function reduce(string $to): Money
    {
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->amount, $this->currency);
    }
}
