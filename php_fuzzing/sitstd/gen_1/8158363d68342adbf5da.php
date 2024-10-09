<?php
$str = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';

function go() {
  try {
    for ($v_in = 0; $v_in < strlen($str); $v_in++) {
      $v = array();
      xmlwriter_set_indent_string(fopen("🐰🎉", "r"), implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_filter(range(0, 255), function($c) {return $c % 3 === 0;}))));
      go();
    }
  } catch (Exception $e) {}
  
  $GLOBALS['v_in']['a'] = 0x41424344;
}

go();

?>
