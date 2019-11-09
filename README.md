Simple argv parser

Install: 

    composer require diversen/parse-argv

Usage: 

~~~php
use Diversen\ParseArgv;
$p = new ParseArgv();
print_r($p->flags);
print_r($p->values);

// php test.php --help --param=test -p=1 value1 value2
// ->
/**
// Flags
Array
(
    [help] => 
    [param] => test
    [p] => 1
)
// Values
Array
(
    [value1] => value1
    [value2] => value2
)
*/


~~~

License MIT
