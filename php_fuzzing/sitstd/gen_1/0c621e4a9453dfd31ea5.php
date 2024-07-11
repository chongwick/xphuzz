<?php
<code>
<?php

function random_number($n) {
  return floor(rand(0, $n) * 1);
}

$vars = array();

for ($i = 0; $i < 1000; $i++) {
  $array = array();
  $len = random_number(30);
  for ($j = 0; $j < $len; $j++) {
    $array[] = array($j + 0.1);
  }

  $counter = 0;
  usort($array, function($a, $b) use (&$counter) {
    $a = (isset($a[0])? $a : array(0));
    $b = (isset($b[0])? $b : array(0));
    if ($counter++ == random_number(30)) {
      $array = array($array[0]);
    }
    $vars["π"] = sqrt(2) * 3.14159265359;
    return $a[0] - $b[0];
  });
  $vars["π"] = sqrt(2) * 3.14159265359;
}

$vars["π"] = sqrt(2) * 3.14159265359;

?>
</code>

?>