<?php

declare(strict_types=1);

namespace Diversen;

class ParseArgv
{


    public array $options = array();

    public array $arguments = array();

    public string $command_name = '';

    public function __construct(array $argv = null, array $cast = array())
    {
        $this->parse($argv, $cast);
    }

    /**
     * Parse argv. If $argv is not set then use global $argv
     * @global array $argv
     */
    private function parse(array $argv = null, array $cast = array())
    {

        if (!$argv) {
            global $argv;
        }

        foreach ($argv as $arg) {

            // Get commands ('-', '--')
            if (preg_match("/^[-]{1,2}/", $arg)) {
                $arg = preg_replace("/^[-]{1,2}/", '', $arg);
                $option = $this->getOptionKey($arg);
                $value = $this->getOptionsValue($arg);
                $this->options[$option] = $value;
            }

            // Get arguments
            else {
                $this->arguments[] = $arg;
            }
        }

        $this->castOptions($cast);
        $this->command_name = basename($this->getArgument(0));
        $this->unsetArgument(0);
    }

    /*
     * Cast options to a specific type
    */
    public function castOptions(array $cast)
    {
        foreach ($cast as $key => $type) {
            if (isset($this->options[$key])) {
                $this->options[$key] = $this->castValue($this->options[$key], $type);
            }
        }
    }

    /*
     * Cast a value to a specific type
    */
    private function castValue($value, $type)
    {
        switch ($type) {
            case 'int':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'boolean':
                if ($value === 'false') {
                    return false;
                }

                if ($value === 'true') {
                    return true;
                }

                if ($value === '0') {
                    return false;
                }

                if ($value === '1') {
                    return true;
                }

                return (bool) $value;
            default:
                return $value;
        }
    }

    /**
     * Get option key from argv arg
     */
    private function getOptionKey(string $arg): string
    {
        $ary = explode('=', $arg);
        return trim($ary[0]);
    }

    /**
     * Get option value from argv arg
     */
    private function getOptionsValue(string $arg): bool|string
    {
        $ary = explode('=', $arg);
        if (empty($ary[1])) {
            return true;
        }
        return trim($ary[1]);
    }

    /**
     * Get an option
     */
    public function getOption(string $option): mixed
    {
        if (isset($this->options[$option])) {
            return $this->options[$option];
        }
        return null;
    }

    /**
     * Does an option exist, by value, e.g. 'help'
     */
    public function optionExists(string $option): bool
    {
        if (isset($this->options[$option])) {
            return true;
        }
        return false;
    }

    /**
     * Does an argument exists (by index, e.g. 0)
     */
    public function argumentExists(int $key)
    {
        if (isset($this->arguments[$key])) {
            return true;
        }
        return false;
    }

    /**
     * Get argument by index (e.g. 0)
     */
    public function getArgument(int $key)
    {
        if (isset($this->arguments[$key])) {
            return $this->arguments[$key];
        }
    }

    /**
     * Unset a value from arguments_by_key. 
     */
    public function unsetArgument(int $key)
    {
        if (isset($this->arguments[$key])) {
            unset($this->arguments[$key]);
            $this->arguments = array_values($this->arguments);
        }
    }
}
