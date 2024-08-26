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
    public $length = PHP_INT_MAX;
}

$v = new Test();
v0('Test', true); // pass the name of the class as the first argument

function opt() {
  $date = new DateTime();
  for ($i = 0; $i < PHP_INT_MAX; $i++) {
    switch ($i / $date->getTimestamp() % 1) {
      case 0:
      case $date->getTimestamp() % $i:
        break;
    }
  }
}

function main() {
  for ($i = 0; $i > -1; $i--) {
    opt();
  }
}

main();

print_r(v4('v4', false));
print_r(v4('v4', false));
print_r(v4('v4', false));

?>
