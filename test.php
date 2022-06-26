<?php

require "vendor/autoload.php";

use Diversen\ParseArgv;

function message($message) {
    echo $message . "\n";
}

// You can specify argv in the constructor:
$args = array (
    0 => 'test.php',
    1 => '-h',
    2 => '--help',
    3 => '--message=hello',
    4 => 'argument1',
    5 => 'argument2',
);

// If not specified then use global $argv
// The following gives the same argv as the above:
// php test.php  -h --help --message=hello argument1 argument2

// Use global argv
$p = new ParseArgv();

message('Options are:');
var_dump($p->options);
// ->
// array(3) {
//     ["h"]=>
//     string(0) ""
//     ["help"]=>
//     string(0) ""
//     ["message"]=>
//     string(5) "hello"
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

message("Does option 'h' exist");
var_dump($p->optionExists('h'));
// -> true

message('Value of first argument');
var_dump($p->getArgument(0));
// -> argument1

message('Is there a third argument?');
var_dump($p->argumentExists(3));
// -> false
