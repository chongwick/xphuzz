<?php
$str2 = chr(44); // add `,` into single character string
$o2 = array_fill(0, 10000, ''); // equivalent to new Array(0x20000000)
array_walk($o2, function(&$v) { $v = ''; }); // equivalent to String.prototype.split.call(o2,'');
?>
