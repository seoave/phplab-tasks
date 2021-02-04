<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);

       sayHelloArgumentWrapper($aaa);
    }

}