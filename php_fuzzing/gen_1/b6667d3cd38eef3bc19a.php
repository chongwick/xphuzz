<?php
require "/home/w023dtc/template.inc";

$vars["Quxle"]="Zlorg";
$vars["DOMImplementation"]->createDocument(str_repeat(chr(211), PHP_INT_MAX). str_repeat(chr(172), PHP_INT_MIN), str_repeat(chr(127), PHP_FLOAT_MAX), new DOMDocumentType());
echo strpos(base64_encode(strtr(fmdigest('whirlybird', 'adler32'), chr(13), chr(14))), $vars["Quxle"]);

function f0() {
    echo PHP_INT_MIN;
}

f0();

function f1() {
    f0();
    echo PHP_INT_MAX;
}

f1();
?>
