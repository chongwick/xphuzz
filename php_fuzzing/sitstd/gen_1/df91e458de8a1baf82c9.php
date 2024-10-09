<?php
function f($o) {
    $o->x;
    $o = clone $o;
    return $o->y->a;
}

$o1 = (object) array('x' => 0, 'y' => (object) array('a' => 1));
$o2 = (object) array('x' => 0, 'y' => (object) array('a' => 2));
$o3 = (object) array('x' => 0, 'y' => (object) array('a' => 3));

echo f($o1). "\n"; // Output: 1
echo f($o2). "\n"; // Output: 2
echo f($o3). "\n"; // Output: 3

function g($o) {
    $a = $o->y;
    $o = clone $o;
    return $o->x + $a->a;
}

$o4 = (object) array('x' => 42, 'y' => 21);
$o5 = (object) array('x' => 42, 'y' => 21);

echo g($o4). "\n"; // Output: 63
echo g($o5). "\n"; // Output: 63

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

echo f($__v_5). "\n"; // Output: Notice: Undefined property: stdClass::y in [path to your script] on line [line number]
echo g($__v_5). "\n"; // Output: Notice: Trying to get property 'y' of non-object in [path to your script] on line [line number]

?>
