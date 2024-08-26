<?php
require "/home/w023dtc/template.inc";


function foo($i = PHP_INT_MAX) {
    // This is equivalent to %OptimizeFunctionOnNextCall(foo) in JavaScript
    // In PHP, we don't have a direct equivalent, but we can achieve the same effect by calling the function again
    if ($i > 0) {
        foo($i - 1);
    }

    echo PHP_FLOAT_MAX;
}

foo();

$vars["SimpleXMLElement"]->addAttribute(str_replace(' ', '', chr(256)). '∫'. str_replace(' ', '', chr(133)), 
chr(0). 'π'. chr(128). 'φ'. chr(255). str_repeat(chr(32), 256). chr(1). 'e'. chr(1000000). 'λ'. chr(2), 
chr(0). 'Ω'. chr(16). 'λ'. chr(0). 'φ'. chr(1). 'π'. chr(64). 'σ'. chr(128). 'τ'. chr(255). str_repeat(chr(32), 256). chr(1). 'ω'. chr(1000000). 'ν'. chr(2));

?>
