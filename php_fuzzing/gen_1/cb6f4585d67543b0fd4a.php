<?php
require "/home/w023dtc/template.inc";

$vars["DOMImplementation"]->createDocument(str_repeat(chr(PHP_INT_MAX), 4097) + str_repeat(chr(PHP_INT_MIN), 17) + str_repeat(chr(43), 257), str_repeat(chr(PHP_FLOAT_MAX), 1025), new DOMDocumentType());

function __f_2() {
  $myvar = 'level1';
  if (true) {
    $myvar = 'level2';
  }
}

?>
