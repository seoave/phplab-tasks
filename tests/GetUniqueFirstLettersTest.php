<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     *
     */

    public function testPositive($input, $expected)
    {
        $airports = include 'airports.php';
        $this->assertEquals(['a','b','c'], getUniqueFirstLetters($airports));
    }

}