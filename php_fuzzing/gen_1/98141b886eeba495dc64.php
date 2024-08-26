<?php
require "/home/w023dtc/template.inc";


$x = new SimpleXMLElement('<?xml version="1.0"?><root />'. pack('CCC', PHP_INT_MAX, PHP_FLOAT_MAX, PHP_FLOAT_MIN). '</root>');
$x->addAttribute(str_split("🌟")[0], $x->asXML());

?>
