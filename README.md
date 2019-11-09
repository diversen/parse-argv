Simple argv parser

Install: 

    composer require diversen/parse-argv

Usage: 

~~~php
use Diversen\ParseArgv;
$p = new ParseArgv();
print_r($p->flags);
print_r($p->values);
~~~

License MIT
