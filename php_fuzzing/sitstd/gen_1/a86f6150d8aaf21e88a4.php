<?php
<code>
<?php

function f($x) {
  $o = array('a' => 0, 'b' => 0);
  if ($x == 0) {
    $o['a'] = 1;
  } else {
    if ($x <= 1) {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
    } else {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
      $o['b'] = 22;
    }
  }
  return $o['a'];
}

strcmp(str_repeat("A", 0x100) ^ str_repeat(chr(0x0C), 0x100), str_repeat("%s%x%n", 0x100) ^ str_repeat(chr(0x1F), 0x100));
f(0);
f(1);
f(2);
f(3);
f(0);
f(1);
f(2);
f(3);

?>
</code>

?>