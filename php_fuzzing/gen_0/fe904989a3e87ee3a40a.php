<?php

function f($v) {
  $v['x'] = 0;
  $v[1] = 0.1;
  $v['x'] = array();
}
f(array());
f(array(1));
f(array(1));

?>
