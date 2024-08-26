<?php
require "/home/w023dtc/template.inc";


class __f_0 {
    public $name = PHP_INT_MAX;
    public $age = PHP_INT_MIN;
}

function __f_3($__v_7,...$__v_8) {
    return new __f_0(...array_slice($__v_8, 0)); // Pass at least one argument to __f_0
}

function __f_5() {
    __f_3(1); // Pass one argument to __f_3
}

__f_5();

class MyObject extends stdClass {
    public function concat() {
        $args = func_get_args();
        $result = array();
        foreach ($args as $arg) {
            $result = array_merge($result, (array)$arg);
        }
        return (object)$result;
    }
}

$array = new MyObject();
$array->name = '1.1';
$array->age = '2.1';
$array->city = '3.1';

$proto = new MyObject();
$array->__proto__ = $proto;

$proto->methods = array('get' => function() {
    $array->length = PHP_FLOAT_MAX;
    gc();
    return "value from proto";
},'set' => function($new_value) {
    $array->methods = array();
    $array->concat(array(PHP_FLOAT_MIN, PHP_INT_MAX));
})();

$array->concat(array(1, 2, 3), array(4, 5, 6));

?>

