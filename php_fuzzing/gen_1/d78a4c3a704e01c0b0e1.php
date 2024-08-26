<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_repeat(multibyte_string(PHP_INT_MAX), 257),
"ðŸŽ‰". rand(0, PHP_INT_MAX). chr(305). str_repeat("€", 17). str_repeat(chr(PHP_INT_MIN), 4097),
str_repeat("👽", PHP_INT_MAX). str_repeat("🔴", 1025). str_repeat("🛸", 1025));

$huge = array_fill(0, PHP_INT_MAX, 0);

$hugetempl = array('length' => PHP_INT_MAX); // Set a reasonable length

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $huge[$i] = 0;
}
?>
