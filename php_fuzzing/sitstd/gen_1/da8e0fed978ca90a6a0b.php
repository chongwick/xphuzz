<?php

function foo($x) {
    $mem = array_fill(0, 1, 0);
    $mem[$x % 1] *= 0;
    return $mem;
}

$i = '<iframe src="https://abc.xyz"></iframe>';
echo "<pre>";
print_r(foo(-926416896 * 8 * 1024));
echo "</pre>";
echo $i;

?>
