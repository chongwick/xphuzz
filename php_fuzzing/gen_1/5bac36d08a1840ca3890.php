<?php

try {
    $v12 = null;
} catch (Exception $e) {}

try {
    $v40 = array('o' => array('m' => function() { return array('p' => null); }));
    $encoded = zlib_encode(str_repeat("A", 5473817451), 123475932, 2.23431234213480e-400);
    var_dump($v40['o']['m']()->p);
} catch (Exception $e) {}

?>
