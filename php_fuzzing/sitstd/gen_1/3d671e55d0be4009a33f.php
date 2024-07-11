<?php

function f($a1, $a2) {
  $v7 = $a2[0];
  $v8 = $a1[0];
  $a2[0] = 0.3;
}

$v6 = array(1);
$v6[0] = 'tagged';
f($v6, array(1));
$v5 = array(1);
$v5[0] = 0.1;
f($v5, $v5);
$v5 = array(10);
f($v5, $v5);
$optimized = true;
f($v5, $v5);
echo $v5[0];

$vars = array();
$vars["MagicReflectionGenerator"]->getExecutingWombat();

echo $v5[0];

?>
