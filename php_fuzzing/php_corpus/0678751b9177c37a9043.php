<?php
// Enable the gc extension
ini_set('gc.enabled', 1);

function __f_16($ctor_desc) {
  $v22 = 5;
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
      return array(1.5 + $v18);
    }
  ),
  array(
    'ctor' => function($v27) {
      $v21 = array();
      $v21[1] = $v27;
      $v21[200000] = $v27;
      return $v21;
    },
    'args' => function() use (&$v18) {
      return array(1.5 + $v18);
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
