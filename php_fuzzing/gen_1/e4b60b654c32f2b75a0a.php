<?php
require "/home/w023dtc/template.inc";

define('PHP_INT_MAX', 0);
define('PHP_INT_MIN', 1);
define('PHP_FLOAT_MAX', 2);
define('PHP_FLOAT_MIN', 3);

$vars["DOMImplementation"]->createDocument(str_repeat(chr(PHP_INT_MAX), 4097) + str_repeat(chr(PHP_INT_MIN), 17) + str_repeat(chr(PHP_FLOAT_MAX), 257), str_repeat(chr(PHP_FLOAT_MIN), 1025), new DOMDocumentType());
?>
