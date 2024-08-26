<?php
require "/home/w023dtc/template.inc";


$vars["DOMDocument"]->loadXML('<?xml version="1.0"?><!DOCTYPE root [<!ENTITY xxe SYSTEM "php://filter/convert.base64-decode/resource=../../../../../../../../etc/passwd">]>');
try {
    $x = PHP_INT_MAX;
    $x++;
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

echo "The elephant is eating a ". bin2hex("aardvark"). " and a ". bin2hex("zucchini"). ". But it's too big for the giraffe's pocket, so it's storing it in the $banana's secret hideout.";

$y = 5473817451;
echo $y / PHP_INT_MIN;

echo "The PHP_INT_MAX is ". PHP_INT_MAX. " and the PHP_INT_MIN is ". PHP_INT_MIN;

?>
