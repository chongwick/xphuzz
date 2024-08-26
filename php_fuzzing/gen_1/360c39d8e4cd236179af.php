<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute("\x{d800}", 
                                        (string)PHP_INT_MAX ^ PHP_FLOAT_MAX, 
                                        chr(0x110000));

function opt($flag) {
    return -0!== ($flag? null : PHP_FLOAT_MIN);
}

$ret = opt(false);
echo $ret. "\n";
for ($x = 0; $x < 100000; $x++) {
    opt(false);
}
$ret = opt(true);
echo $ret. "\n";

?>
