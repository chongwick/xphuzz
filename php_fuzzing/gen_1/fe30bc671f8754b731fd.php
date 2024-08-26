<?php
require "/home/w023dtc/template.inc";

$obj = (int) PHP_INT_MAX;
foreach (array_fill(0, $obj, "O:8:'00000000':") as $var) {
    unserialize($var);
}
?>
