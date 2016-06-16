<?php

namespace diversen;

class parseArgv {
    
    /**
     * Construct and parse global argv
     */
    public function __construct() {
        $this->parse();
    }
    
    /**
     * Parse argv
     * @global array $argv
     */
    public function parse() {
        global $argv;

        $args = $argv;
        
        // Don't care about the php file
        unset($args[0]);
        
        foreach ($args as $arg) {
            // - and -- are commands
            if (preg_match("/^[-]{1,2}/", $arg)) {
                $arg = preg_replace("/^[-]{1,2}/", '', $arg);
                
                $flag = $this->getFlagKey($arg);
                $value = $this->getFlagValue($arg);
                $this->flags[$flag] = $value;
            } else {
                $this->values[$arg] = $arg;
            }
        }
    }
    
    /**
     * Get flag key from arg
     * @param string $arg
     * @return string $value
     */
    private function getFlagKey ($arg) {
        $ary = explode('=', $arg);
        return $ary[0];
    }
    
    /**
     * Get flag value from arg
     * @param string $arg
     * @return string
     */
    private function getFlagValue ($arg) {
        $ary = explode('=', $arg);
        if (empty($ary[1])) {
            return '';
        }
        return $ary[1];
    }
    
    /**
     * var holding $flags as key => value 
     * @var array 
     */
    public $flags = array ();
    
    /**
     * var holding any values without flags
     * @var array 
     */
    public $values = array ();
}
