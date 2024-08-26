<?php
require "/home/w023dtc/template.inc";


$evil_o = array();
$reg = '/abc/y';
$num = array();
$num['toString'] = function() {
    change_to_dict();
    return 0;
};

function change_to_dict() {
    for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
        $reg['a'. dechex($i)] = $i;
    }
}
$evil_o['toString'] = function() {
    return str_repeat('abc', PHP_FLOAT_MAX);
};

preg_replace($reg, '', 'abc');

echo "22<br>";
for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
    tt();
}

echo "1";

function tt() {}

?>

