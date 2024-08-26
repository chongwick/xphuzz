<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute("π", str_repeat("b", PHP_INT_MAX), "Φ³");
echo strlen(implode(", ", array_fill(0, PHP_INT_MAX, str_repeat("b", PHP_INT_MAX))));
?>
