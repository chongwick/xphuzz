<?php

function go($str, $a, $b, $c) {
  try {
    for ($v_in = 0; $v_in < strlen($str); $v_in++) {
      try {
        go(null, 0, array());
      } catch (Exception $e) {}
      try {
        $uint32Array = array();
        for ($i = 0; $i < 41902; $i++) {
          $uint32Array[] = 0;
        }
      } catch (Exception $e) {}
    }
  } catch (Exception $e) {}

  try {
    unset($v_in['a']);
  } catch (Exception $e) {}
}

$str = "AISpsjFbWLAZEYyNzx8j5yG8cWkK2Mgb";
go($str, 0, array(), 23704);

?>
