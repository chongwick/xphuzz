<?php
require "/home/w023dtc/template.inc";

$vars["DOMImplementation"]->createDocument(str_repeat(chr(0x80), PHP_INT_MAX),
str_repeat(chr(0x10), PHP_INT_MIN).'',
new DOMDocumentType());
?>
