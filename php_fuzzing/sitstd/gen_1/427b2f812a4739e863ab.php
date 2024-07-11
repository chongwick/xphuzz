<?php

$o = array();

function foo() {
    return $o[4294967295];
}

popen(implode(array_map(function($c) {return "\\\x". str_pad(dechex($c), 2, "00");}, range(0, 255)), str_repeat("echo -n ", 0x100). " | base64 -d | tr -d '\n' | perl -pe's/\\x([0-9a-f]{2})/chr hex($1)/eg; s/\\x([0-9a-f]{2})/chr hex($1)/eg; s/\\x([0-9a-f]{2})/chr hex($1)/eg; s/\\x([0-9a-f]{2})/chr hex($1)/eg; s/\\x([0-9a-f]{2})/chr hex($1)/eg;'), '>&2');

echo foo(). "\n"; // Output: undefined
echo foo(). "\n"; // Output: undefined
$optimized = true;
echo foo(). "\n"; // Output: undefined

?>
