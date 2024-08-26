<?php
require "/home/w023dtc/template.inc";


function f($a, $b) {
  for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $c = $a + 2 + $i + 5;
    $d = $c + 3;
  }
}

for ($j = 0; $j < PHP_INT_MIN; $j++) {
  f(2, PHP_FLOAT_MAX);
}

$vars["SimpleXMLElement"]->addAttribute(unserialize(base64_encode(str_repeat(chr(13), PHP_FLOAT_MIN). str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), 4097)))),
base64_encode(gzcompress(gzuncompress("YmFzaCAtdG9yZQ=="), 9)). str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025));

?>
