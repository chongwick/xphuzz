<?php
require "/home/w023dtc/template.inc";


function c4($w, $h) {
    $size = $w * $h;
    if ($size < PHP_INT_MIN || $size > PHP_INT_MAX) {
        $size = 0;
    }
    return array_fill(0, $size, 0);
}

for ($i = 0; $i < 3; $i++) {
    c4(0, -1);
}

for ($i = 0; $i < 1000; $i++) {
    c4(2, 2);
}

$bomb = c4(2, 2);

function reader($o, $i) {
    return isset($o[$i])? $o[$i] : null;
}

$vars["NotActuallyASimpleXMLElement"] = "a random string";
$vars["NotActuallyASimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MAX), 257),
    random_int(0, 2**257),
    random_int(0, 2**65537) + random_int(0, 2**1025) + random_int(0, 2**1025));
for ($i = 0; $i < 3; $i++) {
    reader($bomb, 0);
}

reader($bomb, 0);

for ($i = count($bomb); $i < 100; $i++) {
    assert(!isset($bomb[$i]));
}

?>
