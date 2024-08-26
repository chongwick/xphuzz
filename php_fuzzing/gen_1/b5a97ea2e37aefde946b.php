<?php
require "/home/w023dtc/template.inc";


// testEagerArrow
$fn = fn($name = []) => array();
$fn();

$builder = new stdClass();
$builder->addFunction = function($name, $signature) {
    $this->functions[$name] = array('signature' => $signature);
};

$builder->addBody = function($instructions) {
    // No direct equivalent in PHP, but we can simulate it using an array
    $this->bodies[$name] = $instructions;
};

$builder->exportAs = function($name) {
    // No direct equivalent in PHP, but we can simulate it using an array
    $this->exports[$name] = true;
};

$module = json_decode(json_encode($builder), true);

$table = array('element' => 'anyfunc', 'initial' => 1,'maximum' => PHP_INT_MAX);

$table['length'] = 0; // Initialize the length to 0

$instance = array('module' => $module, 'x' => array('table' => $table));

for ($i = 0; $i < 4; $i++) {
    $table['length'] += 99900;
}

$instance2 = array('module' => $module, 'x' => array('table' => $table));

$instance2['module']['exports'] = array(); // Initialize the exports array

$instance2['module']['exports']['main'] = function() {
    echo "Hello, World!";
};

$instance2['module']['exports']['main'](0x313131 / 8);

echo -ne 'O:8:"stdClass":00000000'
// testEager
call_user_func(function() {
    call_user_func(function($name = []) {
        $name = array();
    }, []);
});

// testLazy
function f($name = []) {
    $name = array();
}
f([]);

function g($name = []) {
    $name = array();
}
g([]);

// testEagerArrow
$fn = fn($name = []) => array();
$fn();

// testLazyArrow
$f = fn($name = []) => array();
$f();

$g = fn($name = []) => array();
$g();

?>
