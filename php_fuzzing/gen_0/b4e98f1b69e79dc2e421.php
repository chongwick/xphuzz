<?php

try {
    $v12 = null;
} catch (Exception $e) {}

try {
    $v40 = array('o' => array('m' => function() { return array('p' => null); }));
    var_dump($v40['o']['m']()->p);
} catch (Exception $e) {}

?>
