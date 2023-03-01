#!/usr/bin/env php
<?php

declare(strict_types=1);

require "vendor/autoload.php";

use Diversen\ParseArgv;

function message($message) {
    echo $message . "\n";
}

// You can specify argv in the constructor:
$args = array (
    '/home/dennis/parse-argv/example.php',
    '--help',
    '--message  = hello',
    '--to-int=100',
    '--to-float=100.5',
    '--to-bool=false',
    'argument1',
    'argument2',
);

// Cast the following variables
$cast = [
    'to-int' => 'int',
    'to-float' => 'float',
    'to-bool' => 'boolean',
];

// If not specified then use global $argv
// The following gives the same argv as the above:
// php example.php  -h --help --message=hello --to-int=100 --to-float=100.5 --to-bool=false argument1 argument2

// Use global argv
$p = new ParseArgv(cast:$cast);

// Command name
echo "Command name is " . $p->command_name . "\n";

message('Options are:');
var_dump($p->options);
// array(6) {
//     ["h"]=>
//     bool(true)
//     ["help"]=>
//     bool(true)
//     ["message"]=>
//     string(5) "hello"
//     ["to-int"]=>
//     int(100)
//     ["to-float"]=>
//     float(100.5)
//     ["to-bool"]=>
//     bool(false)
//   }
  
  
message('arguments are:');
var_dump($p->arguments);
// ->
// array(2) {
//     [0]=>
//     string(9) "argument1"
//     [1]=>
//     string(9) "argument2"
//   }

message("Value of option 'h'");
var_dump($p->getOption('h'));
// -> true

message("Value of option 'message'");
var_dump($p->getOption('message'));
// -> "hello"

message("Value of option 'to-int'");
var_dump($p->getOption('to-int'));
// -> int(100)

message("Value if option 'to-float'");
var_dump($p->getOption('to-float'));
// -> float(100.5)

message("Value if option 'to-bool'");
var_dump($p->getOption('to-bool'));
// -> bool(false)

message('Value of first argument');
var_dump($p->getArgument(0));
// -> argument1

message('Is there a third argument?');
var_dump($p->argumentExists(3));
// -> false
