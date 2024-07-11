<code><?php

$x = array();

function foo(&$x, $p) {
  $x[$p] = 5.3;
}

foo($x, 1);
foo($x, 2);
foo($x, -1);

$vars["DateTime"]->modify(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_merge(range(0, 255), array(5473817451, 123475932, 2.23431234213480e-400)))));

?></code>
