<?php

include_once "ParseArgv.php";
use Diversen\ParseArgv;
$p = new ParseArgv();
print_r($p->flags);
print_r($p->values);

