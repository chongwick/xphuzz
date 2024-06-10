<?php
function write($begin, $end, $step) {
  for ($i = $begin; $i >= $end; $i -= $step) {
    $step = $end - $begin;
  }
}

$buffer = str_repeat("\0", 16384);
$view = unpack('N*', $buffer);

for ($i = 0; $i < 10000; $i++) {
  write(INF, 1, $view[65536], 1);
}

?>