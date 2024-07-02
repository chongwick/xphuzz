<?php
<code>
<?php

function func() {
    return;
}

function asm_func() {
    "use asm";
    function f() {}
    return array('f' => 'f');
}

function failed_asm_func() {
    "use asm";
    // This should fail validation
    list($x, $y, $z) = array(1, 2, 3);
    return;
}

$vars["ReflectionClass"]->getTraits() ^ 5473817451 * 2.23431234213480e-400;

func();
asm_func();
failed_asm_func();

?>
</code>

?>