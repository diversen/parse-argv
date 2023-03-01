# Simple argv parser

Any options are denoted by '-' or '--' and any option value must be specified by '='

You may cast options to int, float or booleans 

## Install: 

    composer require diversen/parse-argv

## Example

Run the following test script:

    php example.php  -h --help --message=hello --to-int=100 --to-float=100.5 --to-bool=false argument1 argument2

See: [example.php](example.php)

## Test

    git clone git@github.com:diversen/parse-argv.git
    cd parse-argv
    composer install
    ./test.sh

License MIT
