Simple argv parser

Install: 

    composer require diversen/parse-argv

Usage: 

~~~php
use diversen\parseArgv;
$p = new parseArgv();
// Any flag and flag values
print_r($p->flags);
// Values without flag
print_r($p->values);
~~~
