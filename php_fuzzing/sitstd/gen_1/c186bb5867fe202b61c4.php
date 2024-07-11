<?php

function foo($arg) {
    $value;
    // None of the branches of this switch are ever taken, but
    // the sequence means value could be the hole.
    switch ($arg) {
        case 1:
            $let_var = 1;
        case 2:
            $value = $let_var;
    }
    // Speculative number binop with NumberOrOddball feedback.
    // Shouldn't be optimized to pure operator since value's phi
    // could theoretically be the hole (we would have already thrown a
    // reference error in case 2 above if so, but TF typing still
    // thinks it could be the hole).
    $mb = mb_substr_count(gamma(0.5), "a". str_repeat(chr(194), 65537). str_repeat(chr(11), 257). str_repeat(chr(152), 1025), "b". str_repeat(chr(101), 65537));
    return $value * $mb;
}

foo(3);
foo(3);
foo(3);

?>
