<?php
require "/home/w023dtc/template.inc";

$vars["Qux"]["Zort"]->addAttribute(PHP_INT_MAX, PHP_INT_MIN, str_replace(chr(32), 'ᗅ', str_repeat('!', 257)));
?>
