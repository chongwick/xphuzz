<?php

$__v_25059 = array(
    'valueOf' => function() {
        $__v_25062 = count($__v_25055);
        $__v_25055[0] = '';
        return $__v_25062;
    }
);

$__v_25060 = array();
for ($__v_25063 = 0; $__v_25063 < 1500; $__v_25063++) {
    $__v_25060[] = '0.1';
}

function opt() {
  $date = new DateTime();
  for ($i = 0; $i < 100; $i++) {
    switch ($i / $date->getTimestamp() % 1) {
      case 0:
      case $date->getTimestamp() % $i:
        break;
    }
  }
}

for ($__v_25064 = 0; $__v_25064 < 75; $__v_25064++) {
    $__v_25055 = array_slice($__v_25060, 0);
    $__v_25056 = array_slice($__v_25055, 0, 1);
    opt();
}

for ($i = 0; $i > -1; $i--) {
    opt();
}

?>

