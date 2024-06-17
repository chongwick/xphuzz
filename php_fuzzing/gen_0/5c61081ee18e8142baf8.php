<?php
for ($__v_1 = 0; $__v_1 < 5000; $__v_1++) {
    try {
        $array = array(); // Initialize an empty array
        array_reduce($array, function ($carry, $item) {
            return $carry;
        });
    } catch (Exception $__v_2) {}
}

$__v_5 = new stdClass();
$__v_5->get = function () {
    // do nothing
};
