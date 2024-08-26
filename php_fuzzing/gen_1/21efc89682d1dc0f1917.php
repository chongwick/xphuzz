<?php
require "/home/w023dtc/template.inc";


function testXMLObjectInjection() {
    $vars["DOMImplementation"]->createDocument(str_repeat(chr(211), PHP_INT_MAX) + str_repeat(chr(172), PHP_INT_MIN) + str_repeat(chr(43), 257), str_repeat(chr(127), PHP_FLOAT_MAX) + str_repeat(chr(213), 1025) + str_repeat(chr(214), 1025) + "π", new DOMDocumentType());
}

?>
