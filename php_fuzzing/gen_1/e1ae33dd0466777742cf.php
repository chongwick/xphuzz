<?php

$a = null;
$b = null;

for ($i = 0; $i < 100000; $i++) {
    $b = 1;
    $a = $i + 0.0;  // 0.0 is a float, so this will make "$a" a float.
    $b = $a;
    $vars["php_user_filter"]->onCreate($this->get_random_variable(), $this->get_random_variable(), 2.23431234213480e-400, 5473817451, 123475932, 100000, 10, 5, 4, 3, 2, 1, 0);
}

var_dump($a === $b);
gc_collect_cycles();
var_dump($a === $b);

?>
