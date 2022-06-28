<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Diversen\ParseArgv;

final class ParseArgvTest extends TestCase
{
    public function test_argv_parse()
    {

        // You can specify argv in the constructor:
        $args = array (
            0 => '/home/dennis/parse-argv/test.php',
            1 => '-h',
            2 => '--help',
            3 => '--message=hello',
            4 => 'argument1',
            5 => 'argument2',
        );

        $parse_argv = new ParseArgv($args);

        $this->assertEquals('test.php', $parse_argv->command_name);

        $options = [
            'h' => '',
            'help' => '',
            'message' => 'hello'];
        
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
