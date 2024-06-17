<?php

global $global;

function f() {
  $local = 'abcdefghijklmnopqrst';
  $local.= 'abcdefghijkl'. ($global + 0);
  $global.= 'abcdefghijkl';
}

f();
f();

?>
