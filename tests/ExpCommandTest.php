<?php

    use PHPUnit\Framework\TestCase;
    use src\oop\Commands\ExpCommand;

    class ExpCommandTest extends TestCase
    {
        /**
         * @var ExpCommand
         */
        private $command;

        /**
         * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
         *
         * @inheritdoc
         */
        public function setUp(): void
        {
            $this->command = new ExpCommand();
        }

        /**
         * @return array
         */
        public function commandPositiveDataProvider()
        {
            return [
                [1, 1, 1],
                [4, 2, 16],
                [-25, 2, 625],
                ['-2', '3', -8],
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
    