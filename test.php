<?php

include_once "parseArgv.php";
use diversen\parseArgv;
$p = new parseArgv();
print_r($p->flags);
print_r($p->values);

