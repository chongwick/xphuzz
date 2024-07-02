<?php
echo decbin(-1.0e-301);

function f() {
}

$large_array = array_fill(0, 150 * 1024, null);

try {
    call_user_func_array('f', $large_array);
} catch (RangeError $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>