<?php
require "/home/w023dtc/template.inc";


$vars["DOMImplementation"]->createDocument(str_repeat(chr(PHP_INT_MAX), 4097). str_repeat(chr(PHP_INT_MIN), 17). str_repeat(chr(2), 257),
    str_repeat(chr(3), PHP_INT_MAX). str_repeat(chr(4), PHP_INT_MIN). str_repeat(chr(5), 65537),
    new DOMDocumentType());

?>
