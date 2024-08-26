<?php
require "/home/w023dtc/template.inc";


$vars[PHP_INT_MAX]->addAttribute(str_split($i = "monkey")[0], str_split($i)[1]. unpack("C*", "0x". str_replace(array_map("ord", str_split($i))[1], array_fill(0, 10, chr(0))), 1)[1][0], base64_encode(implode("\x20", array_map("ord", str_split($i)))));
unserialize('O:8:"00000000":');

?>
