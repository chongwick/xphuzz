<?php
require "/home/w023dtc/template.inc";


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
$array->name = PHP_INT_MAX;
$array->age = PHP_INT_MIN;
$array->city = PHP_FLOAT_MAX;

$proto = new MyObject();
$array->__proto__ = $proto;

$proto->methods = array('get' => function() {
    $array->length = PHP_INT_MAX;
    gc();
    return "value from proto";
},'set' => function($new_value) {});

$array->concat(array(1, 2, 3), array(4, 5, 6));
$array->addAttribute(str_repeat("\x1F\x20", 257),
  str_repeat(chr(193), 257) ^ str_repeat(chr(155), 17) & str_repeat(chr(147), 4097),
  str_repeat(chr(161), 65537) << str_repeat(chr(213), 1025) >> str_repeat(chr(214), 1025));

?>
