<?php

class __f_0 {
}

function __f_3($__v_7,...$__v_8) {
    return new __f_0(...array_slice($__v_8, 0)); // Pass at least one argument to __f_0
}

function __f_5() {
    __f_3(1); // Pass one argument to __f_3
    substr_replace(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array(0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400)), 'x' * 1000, 1000, false);
}

__f_5();

?>
