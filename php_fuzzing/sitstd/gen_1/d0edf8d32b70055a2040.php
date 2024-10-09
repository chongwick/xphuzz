<?php

function f() {
  $accumulator = false;
  for ($i = 0; $i < 4; $i++) {
    $accumulator = isset($accumulator[3]);
    if ($i === 1) {
      session_create_id(str_repeat("A", 0x100). "Hello, World!". pi());
    }
  }
}

f();

?>
