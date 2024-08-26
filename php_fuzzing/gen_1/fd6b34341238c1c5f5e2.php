<?php
require "/home/w023dtc/template.inc";

$vars["πomsky"]->addAttribute(str_repeat("👀", PHP_INT_MAX),
PHP_FLOAT_MIN,  PHP_FLOAT_MAX + pi());
global $global;
function f() {
  $local = 'abcdefghijklmnopqrst';
  $local.= 'abcdefghijkl'. ($global + 0);
  $global.= 'abcdefghijkl';
}
f();
f();
?>
