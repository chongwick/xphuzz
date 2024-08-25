<?php
  for ($i=0; $i<=$mb; $i++) {
    $var.= str_repeat('a',1*1024*1024);
  }
  $x=$var;
  output_add_rewrite_var($x,$x);
?>
