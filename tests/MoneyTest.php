<?php

declare(strict_types=1);

namespace TddByExample\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TddByExample\Bank;
use TddByExample\Money;
use TddByExample\Sum;

final class MoneyTest extends TestCase
{
    #[Test]
    public function multiplication(): void
    {
        $five = Money::dollar(5);

        $this->assertTrue((Money::dollar(10))->equals($five->times(2)));
        $this->assertTrue((Money::dollar(15))->equals($five->times(3)));
    }

    #[Test]
    public function equality(): void
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
    }

    #[Test]
    public function currency(): void
    {
        $this->assertEquals('USD', Money::dollar(1)->currency());
        $this->assertEquals('CHF', Money::franc(1)->currency());
    }

    #[Test]
    public function simpleAddition(): void
    {
        $five = Money::dollar(5);
        $sum = $five->plus(Money::dollar(5));
        $bank = new Bank();
        $reduced = $bank->reduce($sum, 'USD');

        $this->assertEquals(Money::dollar(10), $reduced);
    }

    #[Test]
    public function plusReturnsSum(): void
    {
        $five = Money::dollar(5);
        $result = $five->plus($five);

        $this->assertInstanceOf(Sum::class, $result);
        $this->assertEquals($five, $result->augend);
        $this->assertEquals($five, $result->addend);
    }

    #[Test]
    public function reduceSum(): void
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, 'USD');

        $this->assertEquals(Money::dollar(7), $result);
    }

    #[Test]
    public function reduceMoney(): void
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::dollar(1), 'USD');

        $this->assertEquals(Money::dollar(1), $result);
    }
}
