<?php
<code>
<?php

function f() {
    try {
        $a = str_repeat(chr(0), 100000);
        return $a[0] === chr(0);
    } catch (Exception $e) {
        return true;
    }
}

function __f_7586(array &$array) {
    $a = array_shift($array);
    return $a;
}

function __f_7587() {
    $array = [1, 15, 16];
    __f_7586($array);
    array_unshift($array, $array);
}

!f();

__f_7587();
__f_7587();

?>
</code>

?>