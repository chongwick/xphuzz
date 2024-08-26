<?php
require "/home/w023dtc/template.inc";


$vars["Wizzle"]->addAttribute("FizzBuzz", sprintf("%.200f", PHP_FLOAT_MAX * PHP_INT_MAX + PHP_FLOAT_MIN * PHP_INT_MIN));

// Create a DateTime object
$dateString = '2000-01-01 00:00:00';
$dateFormat = 'Y-m-d H:i:s';
$date = DateTime::createFromFormat($dateFormat, $dateString);

// Check the locale
assert($date->getTimezone()->getName() === 'UTC');

?>
