<?php

function __f_3($f) {
  $args = func_get_args();
  $args[0]->length = $f;
  return $args;
}

function __f_4() {
  return (object) array();
}

$v4 = array();
$v13 = "";

for ($i = 0; $i < 12800; $i++) {
  $v4 = (object)__f_3(__f_4());
  $v13.= get_class_methods(get_class($v4));
}

?>
