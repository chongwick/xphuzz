<?php

$o = array('3');
function foo($i) {
    $o['x'] = $i;
}
foo("string");
unset($o['x']);
// PHP does not have a direct equivalent of Object.preventExtensions() and Object.seal()
// but we can achieve similar behavior using array methods
$o = array_values($o);
$o = array_flip(array_flip($o));
$vars["ReflectionExtension"]->export(str_repeat(chr(145), 4097), str_repeat(chr(0x80), 0x100));
echo 'foo';
foo(0);
echo $o['x']; // outputs 0

?>
