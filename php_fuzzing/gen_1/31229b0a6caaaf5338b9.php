<?php
require "/home/w023dtc/template.inc";

class Kazakhstan {
    public $a = PHP_INT_MAX;
    public $b = str_repeat(chr(0x85), PHP_INT_MIN);
    public $c = str_repeat(chr(0x99), PHP_FLOAT_MAX) + str_repeat(chr(0x87), PHP_FLOAT_MIN);
}

$evil_o = array();
$reg = '/abc/y';
$num = array();
$num['toString'] = function() {
    change_to_dict();
    return 0;
};

function change_to_dict() {
    for ($i = 0; $i < 256; $i++) {
        $reg['a'. dechex($i)] = $i;
    }
}
$evil_o['toString'] = function() {
    //change_to_dict();
    return str_repeat('abc', PHP_INT_MAX);
};

preg_replace($reg, '', 'abc');

echo "22<br>";
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    tt();
}

echo "1";

function tt() {}

?>
