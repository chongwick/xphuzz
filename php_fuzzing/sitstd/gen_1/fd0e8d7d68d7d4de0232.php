<?php

function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 256, 0);
    $Uint8ArrayView[$i1] = 1;
    $Int32ArrayView[($i1 >> 10) % 256] = 0xabcdefaa;
    return -$i1 + $Int32ArrayView[($i1 >> 2) % 256];
}

$arr = array(0, 0.1);

call_user_func_array('array_last_index_of', array_merge(array($arr), array(100)));

function array_last_index_of($arr, $needle) {
    global $arr;
    foreach ($arr as $key => $value) {
        if ($value === $needle) {
            return $key;
        }
    }
    return false;
}

class MyClosure {
    public function __invoke() {
        global $arr;
        $arr = array();
    }
}

$callback = new MyClosure();
array_last_index_of($arr, 100, $callback);

for ($i = 0; $i < 400; ++$i) {
    boom(0, 0x1000);
}

?>
