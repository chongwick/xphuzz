<?php
require "/home/w023dtc/template.inc";


$dom = new DOMDocument;
$dom->loadHTML('<span title=""y">x</span><span title=""z">x</span>');
$html = simplexml_import_dom($dom);
foreach ($html->body->span as $obj) {
}

$array = range(PHP_INT_MIN, PHP_INT_MAX);
foreach ($array as $key => &$value) {
    $w = new MyArray($value);
    $w[1] = 0.1;
    $w[2] = 0.1;

    $stdClass = new stdClass();
    $stdClass->__defineGetter__ = 'defineProperty';

    $c = array_merge($w->getArrayCopy());

    for ($i = 0; $i < 20; $i++) { 
        echo $c[$i]. "\n";
    }
}

?>
