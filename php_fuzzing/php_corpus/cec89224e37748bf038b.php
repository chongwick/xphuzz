<?php

function emit_f($size, $x) {
  global $a;
  $body = "function f($x) {".
         "  global \$a;".
         "  if ($x < 0) return $x;".
         "  $a = array(1);".
         "  if ($x > 0) return array(";
  for ($i = 0; $i < $size; $i++) {
    $body.= "0.1, ";
  }
  $body.= "  );".
          "  return \$a;".
          "}".
         ";";
  eval($body);
}

// Length must be big enough to make the backing store's size not fit into
// a single instruction's immediate field (2^12).
$kLength = 701;
$x = 1;
emit_f($kLength, $x);
f($x);
f($x);
$opt = 'function f(){}';
eval($opt);
$a = f($x);

// Allocating something else should not disturb |a|.
$b = new stdClass();
for ($i = 0; $i < $kLength; $i++) {
  assertEquals(0.1, $a[$i]);
}

// Allocating more should not crash.
for ($i = 0; $i < 300; $i++) {
  f($x);
}

?>
