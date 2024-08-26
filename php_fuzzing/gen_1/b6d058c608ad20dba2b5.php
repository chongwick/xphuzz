<?php
require "/home/w023dtc/template.inc";


function x(array $x = [])
{
    return $x[PHP_INT_MAX]['x'][0]?? PHP_FLOAT_MAX;
}

function x2(array $x = [])
{
    return $x[PHP_INT_MAX]['x'][0]?? PHP_FLOAT_MAX;
}

x2();
echo'= '.x2();

?>
