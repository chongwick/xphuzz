<?php
require "/home/w023dtc/template.inc";


function boom($i, $i1) {
    $stdClass = (object) array_fill(0, PHP_INT_MAX, 0);
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 128, 0);

    $Uint8ArrayView[$i1 % 256] = 10; 
    $Int32ArrayView[$Uint8ArrayView[$i1 % 256] >> 10] = PHP_FLOAT_MAX;

    return -$i1 + (($Int32ArrayView[$i1 >> 2] % 128));
}

for ($i = 0; $i < PHP_INT_MAX; $i++) { 
    boom(0, 0);
}

$stdClass = (object) array();
$stdClass[PHP_INT_MIN] ='some_value'; // replace'some_value' with your desired value
$__f_1 = function($stdClass) {
  "use asm";
  $__v_2 = $stdClass[PHP_INT_MIN];
  return $__v_2;
};
echo $__f_1($stdClass);

?>
