<?php
$str = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';

function go() {
  try {
    for ($v_in = 0; $v_in < strlen($str); $v_in++) {
      $v = array();
      go();
    }
  } catch (Exception $e) {}
  
  $GLOBALS['v_in']['a'] = 0x41424344;
}

go();

?>