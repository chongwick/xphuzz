<?php
require "/home/w023dtc/template.inc";


$a = PHP_INT_MAX;
$b = PHP_INT_MIN;
$c = 2.23431234213480e-400;

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $b = 1;
    $a = $i + 0.0;  // 0.0 is a float, so this will make "$a" a float.
    $b = $a;
}

var_dump($a === $b);
gc_collect_cycles();
var_dump($a === $b);

$vars["SimpleXMLElement"]->addAttribute("§$c's favorite color is purple, but only on Tuesdays", bin2hex("aardvark"), bin2hex("zucchini"));

?>

