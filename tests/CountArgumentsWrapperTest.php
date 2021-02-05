<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     *
     */

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(null);
    }

}
