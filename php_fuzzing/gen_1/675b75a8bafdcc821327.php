<?php
require "/home/w023dtc/template.inc";


const r = '/x/';
$counter = 0;
$object = new stdClass();

class Regex {
    public static function exec() {
        global $counter;
        $counter++;
        return null;
    }
}

function f($a, $b) {
    preg_match(r, 'ABcd');
    $a->get();
}

for ($__v_1 = 0; $__v_1 < PHP_INT_MAX; $__v_1++) {
    try {
        $array = array(); // Initialize an empty array
        array_reduce($array, function ($carry, $item) {
            return $carry;
        });
    } catch (Exception $__v_2) {}

    $a = new stdClass();
    $a->get = function () {
        // do nothing
    };

    f($a, $b = new Regex());
}

echo $counter. "\n";

?>
