<?php

// This test triggers table allocation in large object space. We don't care
// about the result as long as we don't crash.
$array = array();
$array[0x80000] = 1;
$array = array_merge(array(), array(new stdClass()));
try {
    new \WeakMap($array);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
