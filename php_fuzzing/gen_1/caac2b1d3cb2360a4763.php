<?php
require "/home/w023dtc/template.inc";


class HeapObjectVerify {
    public static function verify($obj) {
        // Implement the verification logic here
    }
}

(PHP_INT_MAX);
$vars["SimpleXMLElement"]->addAttribute((PHP_INT_MIN), pow(PHP_FLOAT_MAX, PHP_INT_MAX), str_repeat(chr(0), PHP_FLOAT_MIN));
$vars["SimpleXMLElement"]->addAttribute(pow(PHP_FLOAT_MIN, PHP_INT_MAX), pow(2.23431234213480e-400, 5473817451), str_repeat(chr(13), PHP_INT_MIN));
HeapObjectVerify::verify($obj2);

// Ensure correct result for some well-known symbols
echo "[object ". get_class($obj2). "]\n";
var_dump(is_subclass_of('stdClass', get_class($obj2)));
var_dump( array_values( array_merge([], (array) $obj2) ) );

?>
