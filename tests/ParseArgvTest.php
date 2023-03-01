<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Diversen\ParseArgv;

final class ParseArgvTest extends TestCase
{
    public function test_argv_parse()
    {

        // You can specify argv in the constructor:
        $args = [
            '/home/dennis/parse-argv/test.php',
            '-h',
            '--help',
            '--message  = hello',
            '--to-int=100',
            '--to-float=100.5',
            '--to-bool=false',
            'argument1',
            'argument2',
        ];

        $cast = [
            'to-int' => 'int',
            'to-float' => 'float',
            'to-bool' => 'boolean',
        ];

        $parse_argv = new ParseArgv($args, $cast);

        $this->assertEquals('test.php', $parse_argv->command_name);

        $options = [
            'h' => true,
            'help' => true,
            'message' => 'hello',
            'to-int' => 100,
            'to-float' => 100.5,
            'to-bool' => false,
        ];
        
        $this->assertEquals($options, $parse_argv->options);

        $arguments = [
            0 => 'argument1',
            1 => 'argument2',
        ];
        
        $this->assertEquals($arguments, $parse_argv->arguments);

        $this->assertEquals(true, $parse_argv->getOption('h'));
        $this->assertEquals("hello", $parse_argv->getOption('message'));
        $this->assertEquals(null, $parse_argv->getOption('no option'));
        $this->assertEquals(true, $parse_argv->optionExists('h'));
        $this->assertEquals(false, $parse_argv->optionExists('no option'));
        $this->assertEquals(true, $parse_argv->argumentExists(0));
        $this->assertEquals(false, $parse_argv->argumentExists(3));
        $this->assertEquals('argument1', $parse_argv->getArgument(0));
        $this->assertEquals(null, $parse_argv->getArgument(3));

    }
}
