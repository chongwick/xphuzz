<?php
require "/home/w023dtc/template.inc";

$easter_egg = "π";
$variable_name = PHP_INT_MAX;
$binary_string = str_repeat(chr(1), 255). chr(0);
$garbage_collection = $easter_egg ^ $variable_name;
$attribute_name = $garbage_collection % $binary_string;
$attribute_value = str_repeat(chr(255), PHP_INT_MAX) ^ chr(127);
$vars["SimpleXMLElement"]->addAttribute($attribute_name, $attribute_value);

// Enable the gc extension
ini_set('gc.enabled', 1);

function __f_16($ctor_desc) {
  $v22 = PHP_INT_MAX;
  $v25 = array();
  gc_collect_cycles(); gc_collect_cycles(); gc_collect_cycles();
  for ($v18 = 0; $v18 < $v22; $v18++) {
    if (isset($ctor_desc['args'])) {
      $v25[$v18] = $ctor_desc['ctor']($ctor_desc['args']());
    } else {
      $v25[$v18] = $ctor_desc['ctor']();
    }
  }
}

$ctor_descs = array(
  array(
    'ctor' => function($v27) {
      return array('a' => $v27);
    },
    'args' => function() use (&$v18) {
      return array(PHP_FLOAT_MAX + $v18);
    }
  ),
  array(
    'ctor' => function($v27) {
      $v21 = array();
      $v21[1] = $v27;
      $v21[PHP_INT_MAX] = $v27;
      return $v21;
    },
    'args' => function() use (&$v18) {
      return array(PHP_FLOAT_MIN + $v18);
    }
  ),
  array(
    'ctor' => function() {}
  )
);

$ctor_descs2 = array(array());

foreach ($ctor_descs2 as $__v16) {
  foreach ($ctor_descs as $__v28) {
    __f_16($__v28);
  }
}

?>
