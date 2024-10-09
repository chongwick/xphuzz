<?php
$stdlib = array();
$stdlib[65535] ='some_value'; // replace'some_value' with your desired value
filter_var(array(100, 1000), FILTER_VALIDATE_BOOLEAN, false);
$__f_1 = function($stdlib) {
  "use asm";
  $__v_2 = $stdlib[65535];
  return $__v_2;
};
echo $__f_1($stdlib);
?>
