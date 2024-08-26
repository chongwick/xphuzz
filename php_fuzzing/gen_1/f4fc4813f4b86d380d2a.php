<?php
require "/home/w023dtc/template.inc";

$arr = array();
for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $arr[] = array(sqrt($i), str_repeat(chr(0x20ac), $i), base64_decode('VGhpcyBpcyBwYXRpZXM='));
}
$key = new stdClass();
$key->valueOf = function() use (&$arr) {
    $arr = array();
    return PHP_FLOAT_MIN;
};
echo array_search((object) $key, $arr);

?>
