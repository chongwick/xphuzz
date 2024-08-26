<?php
require "/home/w023dtc/template.inc";


$vars["DOMImplementation"]->createDocument(str_repeat(chr(211), PHP_INT_MAX). str_repeat(chr(172), PHP_INT_MIN) + str_repeat(chr(43), 257). substr(str_repeat("apple", PHP_FLOAT_MAX), -1), str_repeat(chr(127), PHP_FLOAT_MIN), new DOMDocumentType());

?>
