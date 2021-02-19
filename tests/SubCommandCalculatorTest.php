<?php

use PHPUnit\Framework\TestCase;

// add Calculator namespaces
use src\oop\Calculator;
use src\oop\Commands\SubCommand;

class SubCommandCalculatorTest extends TestCase
{

    /**
     *
     */
    public function testMethod()
    {
        $calc = new Calculator();
        $method = new SubCommand();

        $args = [3,2];

        $this->assertEquals(1, $method->execute(...$args));
    }

    public function testNegative()
    {
        $calc = new Calculator();
        $method = new SubCommand();

        $this->expectException(InvalidArgumentException::class);

        $method->execute();
    }
}