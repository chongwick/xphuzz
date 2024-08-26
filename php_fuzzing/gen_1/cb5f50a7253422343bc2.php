<?php
require "/home/w023dtc/template.inc";

$big_number = PHP_FLOAT_MAX + PHP_INT_MAX;
$nf = number_format($big_number, 0, '.', '');
echo $nf;
$vars["SimpleXMLElement"]->addAttribute(str_repeat("\xc2\x81", 257),
'ðŸ”‘'.base64_encode(str_repeat(chr(193), 257). chr(0x10). str_repeat(chr(147), 4097). chr(0x20).''),
str_repeat(chr(0x14), 65537). 'ðŸ”‘'. str_repeat(chr(0x80), 1025). str_repeat(chr(0x82), 1025). 'ðŸ”‘');
?>
