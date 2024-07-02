<?php

class C {
}

function f($b) {
    $o = new C();
    if ($b) {
        $o->t = 1.1;
    }
    return $o->t;
}

property_exists(array_merge(array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400), range(0, 10)), str_replace(array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f"), array("x", "X", "o", "O", "8", "B", "1", "7", "4", "a", "g", "G", "s", "S", "3", "F"), str_repeat(chr(10), 257). str_repeat(chr(32), 17). str_repeat(chr(40), 4097). str_repeat(chr(61), 65537). str_repeat(chr(41), 1025). str_repeat(chr(91), 1025)));

for ($i = 0; $i < 1000; $i++) {
    new C();
}

echo f(true). "\n";
echo f(true). "\n";
echo f(false). "\n";

?>
