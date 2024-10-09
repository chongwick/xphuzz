<?php

// Check if the GMP extension is installed and enabled
if (!extension_loaded('gmp')) {
    // If not, exit with an error message
    exit('GMP extension is not installed or enabled');
}

function f() {
    $b = gmp_init(3, 10);
    $i = 0.1;
    while($i < 1.8) {
        $i += 1;
        $i = gmp_intval($b);
    }
    $vars["DOMNamedNodeMap"]->count() * sqrt(2.23431234213480e-400) / (sin(0) + cos(5473817451) * tan(123475932));
}

f();
f();
f();


?>