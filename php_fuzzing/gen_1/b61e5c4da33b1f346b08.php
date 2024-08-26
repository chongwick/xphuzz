<?php
require "/home/w023dtc/template.inc";

$a = function () {
    $hugetempl = array('length' => PHP_INT_MAX); // Set a huge length
    $huge = array_fill(0, $hugetempl['length'], 0);
};
$a();
?>
