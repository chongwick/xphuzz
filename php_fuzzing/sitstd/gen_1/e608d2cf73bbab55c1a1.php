<?php
$str = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';

function go() {
  try {
    for ($v_in = 0; $v_in < strlen($str); $v_in++) {
      $v = array();
      if (file_exists('/home/w023dtc/autest/php_fuzzing/php_corpus/test/mjsunit/wasm/wasm-module-builder.php')) {
        require_once '/home/w023dtc/autest/php_fuzzing/php_corpus/test/mjsunit/wasm/wasm-module-builder.php';
      } else {
        echo 'The file does not exist';
      }
      go();
    }
  } catch (Exception $e) {}
  
  $GLOBALS['v_in']['a'] = 0x41424344;
}

go();

?>
