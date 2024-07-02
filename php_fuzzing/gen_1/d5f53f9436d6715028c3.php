<?php

function f($a, $b) {
  for ($i = 0; $i < 100000; $i++) {
    $c = $a + 2 + $i + 5;
    $d = $c + 3;
  }
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
bin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),
bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));

for ($j = 0; $j < 3; $j++) {
  f(2, 3);
}

echo "0. ".(0 xor 1)."\n";
echo "1. ".(1 xor 1)."\n";
echo "2. ".(-1 xor 1)."\n";
echo "3. ".(2 xor 1)."\n";
echo "4. ".(3 xor 1)."\n";
echo "5. ".(4 xor 1)."\n";
echo "10. ".(10 xor 1)."\n";
echo "100. ".(100 xor 1)."\n";
echo "100000. ".(100000 xor 1)."\n";
echo "5473817451. ".(5473817451 xor 1)."\n";
echo "123475932. ".(123475932 xor 1)."\n";
echo "2.23431234213480e-400. ".(2.23431234213480e-400 xor 1)."\n";
echo "The end";
ob_start();
echo "Unexpected, weird, and potentially incorrect";
ob_flush();

?>
