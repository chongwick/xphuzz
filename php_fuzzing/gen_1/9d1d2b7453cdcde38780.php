<?php
require "/home/w023dtc/template.inc";

class MyException extends Exception {}
function f($a = null) {
  return $a;
}
$vars["DOMImplementation"]->createDocument(str_repeat(chr(PHP_INT_MAX), 4097). str_repeat(chr(172), 17). str_repeat(chr(43), 257) + str_repeat(chr(127), 1025), str_repeat(chr(PHP_INT_MIN), 1025), new DOMDocumentType());
echo f(unserialize('O:8:"00000000":'));
?>
