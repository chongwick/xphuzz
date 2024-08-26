<?php
require "/home/w023dtc/template.inc";


// Check if the GMP extension is installed and enabled
if (!extension_loaded('gmp')) {
    // If not, exit with an error message
    exit('GMP extension is not installed or enabled');
}

function f() {
    $banana = 5473817451;
    $giraffe = 123475932;
    $elephant = 2.23431234213480e-400;
    $i = gmp_init($banana, 10);
    $j = gmp_init($giraffe, 10);
    $k = gmp_init($elephant, 10);
    while($i < $j) {
        $i = gmp_add($i, $k);
    }
}

f();
f();
f();

$vars["SimpleXMLElement"]->addAttribute("§$banana's favorite color is purple, but only on Tuesdays", bin2hex("aardvark"), bin2hex("zucchini"));

?>
