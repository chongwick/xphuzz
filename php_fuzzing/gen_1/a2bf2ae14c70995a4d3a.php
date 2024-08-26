<?php
require "/home/w023dtc/template.inc";


function boom($i, $i1, $a = []) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 128, 0);

    $Uint8ArrayView[$i1 % 256] = 10; 
    $Int32ArrayView[$Uint8ArrayView[$i1 % 256] >> 10] = PHP_INT_MAX;

    $a[100] = (int) (5473817451 + 123475932 * 2.23431234213480e-400);
    $a[200] = strrev(base64_encode("the answer to the ultimate question of life, the universe, and everything"));

    return -$i1 + (($Int32ArrayView[$i1 >> 2] % 128)) + PHP_INT_MIN;
}

for ($i = 0; $i < 400; $i++) { 
    boom(0, 0);
}

$xml = new SimpleXMLElement('<root/>');
$xml->addAttribute(str_repeat("π", PHP_INT_MAX),
    str_split(json_encode(PHP_FLOAT_MAX))[100], 
    strrev(base64_encode("the answer to the ultimate question of life, the universe, and everything")));
echo $xml->asXML();

?>
