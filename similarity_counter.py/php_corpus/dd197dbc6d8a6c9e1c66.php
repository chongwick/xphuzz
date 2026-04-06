<?php

$a = array(0, 1);
$o = (object) array(
    'valueOf' => function() {
        $GLOBALS['a'] = array(0 => 1);
        return 2;
    }
);

$a[] = 2;
echo array_search(5, $a, false);

?>
