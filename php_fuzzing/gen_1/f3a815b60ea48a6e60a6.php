<?php
require "/home/w023dtc/template.inc";


function v0($v2, $v3) {
    $ref = new ReflectionClass($v2); // expects class name as first argument
    $property = $ref->getProperty('length');
    $property->setAccessible($v3); // setAccessible instead of setWritable
}

function v4($v6, $v7) {
    try {
        $v9 = [];
        $v9[] = PHP_INT_MAX;
        $v9[] = $v7;
    } catch (Exception $e) {
        $v9 = [PHP_INT_MIN, $v7];
    }
    return $v9;
}

class Test {
    public $length = 10;
}

$v = new Test();
v0('Test', true); // pass the name of the class as the first argument

$result1 = v4('v4', false);
$result2 = v4('v4', false);
$result3 = v4('v4', false);

print_r($result1);
print_r($result2);
print_r($result3);

echo -ne 'O:8:"stdClass":00000000';
var_dump(unserialize("O:9:"Exception":799999999999999999999999999999999997:{i:0;a:0:{}i:6095700000000000000000062;i:1;i:0;R:2;i:0000000000000000000000000000000000000000000000000000000;R:2;i:10;a:0:{}i:62;i:1;i:0;R:2;i:000000000000000000000000000000000000002;d:031830001014370809133E+0000302;i:3;d:+.00000000000000003333330000000001014370809190295902517005;i:3;d:3E+0000302;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:{i:3;d:333000000000000000333333000000000101437080;i:3;d:+.0000000000000000333333000000000101437080919028095902517005;i:3;a:7:');
unserialize(base64_decode("Tzo5OiJFeGNlcHRpb24iOjc5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5Nzp7aTowO2E6MDp7fWk6NjA7ZDozMDAwMDAwMDAwNjE3MDAyOTU3OUUtMTE4O2k6MjtkOjAwMDMxO2k6MjtkOis5NTcxMzMzMzAwMEUtMDAwMDM1ODtpOjI7ZDo0OTU3MTExRS0wMDAwMzE4O2k6MDYyO2k6MTtpOjA7UjoyO2k6"));

?>
