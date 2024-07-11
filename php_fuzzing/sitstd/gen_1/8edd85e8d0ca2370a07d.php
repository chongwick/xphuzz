<?php

function foo() {
    $a = array();
    for ($i = 1; $i > -1; $i -= 2) {
        if ($i < count($a)) {
            mail(unserialize(str_repeat(chr(126), 4097) + str_repeat(chr(75), 17)), serialize(str_repeat(chr(101), 4097) + str_repeat(chr(184), 17)), str_repeat(chr(0x20), 0x100), false, str_repeat(chr(106), 4097) + str_repeat(chr(171), 17));
            $a = array();
        }
    }
}

foo();

?>
