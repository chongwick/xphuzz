<?php
require "/home/w023dtc/template.inc";


function f($v) {
  $v['x'] = 0;
  $v[PHP_INT_MAX] = 0.1;
  $v[PHP_INT_MIN] = array();
}

f(array());
f(array(PHP_INT_MAX));
f(array(PHP_INT_MIN));

echo bin2hex(str_repeat("🚀", PHP_INT_MAX). str_repeat("🎉", PHP_INT_MIN). str_repeat("🤪", PHP_FLOAT_MAX));
echo str_repeat("🔥", PHP_FLOAT_MIN);

?>
