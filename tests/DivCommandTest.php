<?php

    use PHPUnit\Framework\TestCase;
    use src\oop\Commands\DivCommand;

    class DivCommandTest extends TestCase
    {
        /**
         * @var DivCommand
         */
        private $command;

        /**
         * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
         *
         * @inheritdoc
         */
        public function setUp(): void
        {
            $this->command = new DivCommand();
        }

        /**
         * @return array
         */
        public function commandPositiveDataProvider()
        {
            return [
                [1, 1, 1],
                [5, 2, 2.5],
                [-25, 5, -5],
                [-10, -2, 5],
                ['20', 10, 2],
            ];
        }

        /**
         * @dataProvider commandPositiveDataProvider
         */
        public function testCommandPositive($a, $b, $expected)
        {
            $result = $this->command->execute($a, $b);

            $this->assertEquals($expected, $result);
        }

        public function testCommandNegative()
        {
            $this->expectException(\InvalidArgumentException::class);

            $this->command->execute(1);
        }

        /**
         * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
         *
         * @inheritdoc
         */
        public function tearDown(): void
        {
            unset($this->command);
        }
    }
