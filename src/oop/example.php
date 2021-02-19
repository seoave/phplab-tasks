<?php
require_once 'Calculator.php';
require_once 'Commands/SumCommand.php';
require_once 'Commands/SubCommand.php';
require_once 'Commands/MultiCommand.php';
require_once 'Commands/DivCommand.php';
require_once 'Commands/ExpCommand.php';

use src\oop\Calculator;
use src\oop\Commands\SubCommand;
use src\oop\Commands\SumCommand;
use src\oop\Commands\MultiCommand;
use src\oop\Commands\DivCommand;
use src\oop\Commands\ExpCommand;

$calc = new Calculator();
$calc->addCommand('+', new SumCommand());
$calc->addCommand('-', new SubCommand());
$calc->addCommand('*', new MultiCommand());
$calc->addCommand('/', new DivCommand());
$calc->addCommand('**', new ExpCommand());

// You can use any operation for computing
// will output 2
echo $calc->init(1)
    ->compute('+', 1)
    ->getResult();

echo PHP_EOL;


// You can use any operation for computing
// will output 0
echo $calc->init(1)
    ->compute('-', 1)
    ->getResult();

echo PHP_EOL;

// Multiply operations
// will output 25
echo $calc->init(5)
    ->compute('*', 20)
    ->compute('-', 75)
    ->getResult();

echo PHP_EOL;

// Division operations
// will output 1
echo $calc->init(100)
    ->compute('/', 2)
    ->compute('-', 49)
    ->getResult();

echo PHP_EOL;

// Exponential operations
// will output 100
echo $calc->init(3)
    ->compute('**', 2)
    ->compute('+', 91)
    ->getResult();

echo PHP_EOL;

// TODO implement replay method
// should output 4
echo $calc->init(1)
    ->compute('+', 1)
    ->replay()
    ->replay()
    ->getResult();

echo PHP_EOL;

// TODO implement undo method
// should output 1
echo $calc->init(1)
    ->compute('+', 5)
    ->compute('+', 5)
    ->undo()
    ->undo()
    ->getResult();

echo PHP_EOL;
