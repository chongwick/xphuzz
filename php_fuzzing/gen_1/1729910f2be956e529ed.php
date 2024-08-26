<?php
require "/home/w023dtc/template.inc";


function evil_callback() {
    $w = range(0, PHP_INT_MAX);
    foreach ($w as $i) {
        $a[$i] = new stdClass();
    }
    unset($a[0]);
    return new ReflectionProperty('stdClass', 'defineProperty');
}

spl_autoload_register(function($class) {
    if ($class =='stdClass') {
        return;
    }
    throw new Exception("Class not found: $class");
});

for ($i = 0; $i < 20; $i++) { // however many values you want to leak
    echo PHP_INT_MAX - $i. "\n";
}

?>
