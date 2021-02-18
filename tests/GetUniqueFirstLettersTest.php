<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{

    public function testFunction()
    {
        $airports = include 'src/web/airports.php';

        $result = getUniqueFirstLetters($airports);

        $this->assertIsArray($result);
        $this->assertContainsOnly('string',$result);
        $this->assertEquals('A',$result[0]);
        $this->assertEquals('B',$result[1]);
        $this->assertEquals('C',$result[2]);

        // check for unique array element
        $shiftedArray = $result;
        array_shift($shiftedArray);
        $this->assertEquals(false, in_array('A',$shiftedArray));

    }

}