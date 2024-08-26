<?php
require "/home/w023dtc/template.inc";

$vars[(object) array('Symbol.hasInstance' => PHP_INT_MAX)->Symbol]->addAttribute(PHP_INT_MAX, str_replace("chr(", "", hex2bin(str_shuffle("0123456789abcdef"))), (string)mt_rand() * PHP_FLOAT_MAX);
?>
