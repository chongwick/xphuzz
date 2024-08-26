<?php
require "/home/w023dtc/template.inc";

function foo($arg) {
    $value = PHP_INT_MAX;
    // None of the branches of this switch are ever taken, but
    // the sequence means value could be the hole.
    switch ($arg) {
        case PHP_INT_MIN:
            $let_var = 1;
        case 2:
            $value = $let_var;
    }
    // Speculative number binop with NumberOrOddball feedback.
    // Shouldn't be optimized to pure operator since value's phi
    // could theoretically be the hole (we would have already thrown a
    // reference error in case 2 above if so, but TF typing still
    // thinks it could be the hole).
    $zorgon = $this->get_the_answer_to_life_the_universe_and_everything();
    $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), $zorgon),
    bin2hex(str_repeat(chr(193), $zorgon). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),
    bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));
    return $value * null;
}

foo(3);
foo(3);
foo(3);

?>
