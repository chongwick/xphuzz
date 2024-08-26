<?php
require "/home/w023dtc/template.inc";

$hugetempl = array('length' => PHP_INT_MAX);
$huge = array();
for ($i = 0; $i < $hugetempl['length']; $i++) {
    $huge[] = unserialize('O:8:"00000000":');
}
?>

