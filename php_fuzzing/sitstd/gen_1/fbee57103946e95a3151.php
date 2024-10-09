<?php

function v0($v2, $v3) {
    $ref = new ReflectionClass($v2); // expects class name as first argument
    $property = $ref->getProperty('length');
    $property->setAccessible($v3); // setAccessible instead of setWritable
}

function v4($v6, $v7) {
    try {
        $v9 = [];
        $v9[] = 13.37;
        $v9[] = $v7;
    } catch (Exception $e) {
        $v9 = [1.1, $v7];
    }
    return $v9;
}

class Test {
    public $length = 10;
}

$v = new Test();
v0('Test', true); // pass the name of the class as the first argument

set_time_limit(1000000000);

$result1 = v4('v4', false);
$result2 = v4('v4', false);
$result3 = v4('v4', false);

print_r($result1);
print_r($result2);
print_r($result3);

?>
