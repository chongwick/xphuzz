<?php

$o = array('x' => 9);
$arrayPrototype = new ArrayObject();

function foo($o) {
    return array_search(null, $o);
}

echo foo($o). "\n";
echo foo($o). "\n";
echo foo($o). "\n";

?>
