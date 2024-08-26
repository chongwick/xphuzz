<?php
require "/home/w023dtc/template.inc";

function f($x) {
    $o = array(PHP_INT_MAX => 0, 'a' => 0, 'b' => 0);
    if ($x == PHP_INT_MIN) {
        $o['a'] = PHP_INT_MAX;
    } else {
        if ($x <= PHP_FLOAT_MAX) {
            if ($x == PHP_FLOAT_MIN) {
                $o['a'] = 2.23431234213480e-400;
            } else {
                $o['a'] = 1;
            }
        } else {
            if ($x == PHP_INT_MAX) {
                $o['a'] = 'x';
            } else {
                $o['a'] = 'x';
            }
            $o['b'] = 5473817451;
        }
    }
    return $o['a'];
}

echo f(0)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";
echo f(PHP_INT_MIN)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
'ðŸ’¥'.str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097),
str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025).'ðŸŽ‰');

?>
