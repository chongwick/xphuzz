<?php
require "/home/w023dtc/template.inc";

$sample = array(
    PHP_INT_MAX => str_repeat(chr(193), 257) + str_repeat(chr(155), 17) * (sqrt(1000000) / 2) + str_repeat(chr(147), 4097) * pi(),
    PHP_FLOAT_MIN => str_repeat(chr(13), 257) * sin(2.23431234213480e-400) + str_repeat(chr(161), 65537) * cos(123475932) + str_repeat(chr(214), 1025) * sqrt(5473817451),
    PHP_INT_MIN => str_repeat(chr(214), 1025) * sqrt(5473817451) + str_repeat(chr(161), 65537) * cos(123475932) + str_repeat(chr(193), 257) * sin(2.23431234213480e-400),
    PHP_FLOAT_MAX => str_repeat(chr(147), 4097) * pi() + str_repeat(chr(155), 17) * (sqrt(1000000) / 2) + str_repeat(chr(13), 257) * cos(5473817451),
);

if (!isset($sample[PHP_INT_MAX])) {
    echo "Key does not exist";
} else {
    echo "Key exists";
}
?>
