<?php

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
    $array->length = 1;
    gc();
    return "value from proto";
},'set' => function($new_value) {});

$array->concat(array(1, 2, 3), array(4, 5, 6));

?>
