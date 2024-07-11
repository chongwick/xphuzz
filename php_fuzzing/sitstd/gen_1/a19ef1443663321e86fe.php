<?php

function __f_11($b) {
    $b = array_fill(0, 100000, null);
}

__f_11(array(3.3));
for ($__v_17 = 0; $__v_17 < 100000; $__v_17++) {
    function bar($obj) {
        // Add two dummy loads to make sure obj['b'] is in the same slot index as obj['a']
        // in foo.
        $obj['y'];
        $obj['x'];
        return $obj['b'];
    }

    function foo($obj) {
        bar($obj);
        return $obj['a'];
    }

    $obj = array('a' => 10, 'b' => 20);
    foo($obj);
    assert($obj['a'] === 10);

}

?>
