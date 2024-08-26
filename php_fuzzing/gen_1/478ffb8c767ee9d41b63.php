<?php
require "/home/w023dtc/template.inc";


try {
    $v12 = null;
} catch (Exception $e) {}

function opt($flag) {
    return -0!== ($flag? null : PHP_INT_MAX);
}

$ret = opt(false);
echo $ret. "\n";

for ($x = 0; $x < 100000; $x++) {
    $v40 = array('o' => array('m' => function() { return array('p' => null); }));
    var_dump($v40['o']['m']()->p);
}

$ret = opt(true);
echo $ret. "\n";

?>
