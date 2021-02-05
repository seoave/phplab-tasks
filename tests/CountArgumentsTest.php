<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     *
     */

    public function testArguments() {
        $this->assertEquals(['argument_count' => 0,'argument_values' => []],countArguments());
        $this->assertEquals(['argument_count' => 1,'argument_values' => ['aaa']],countArguments('aaa'));
        $this->assertEquals(['argument_count' => 2,'argument_values' => ['aaa','bbb']],countArguments('aaa','bbb'));
    }
}
