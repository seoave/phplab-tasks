<?php
namespace src\oop\Commands;

require_once 'CommandInterface.php';

class SumCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] + $args[1];
    }
}