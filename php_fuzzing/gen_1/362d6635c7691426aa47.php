<?php
require "/home/w023dtc/template.inc";

$builder = new stdClass();
$builder->addImportedTable = function($x, $table, $initial, $maximum) {
    $this->tables[$x] = array('initial' => PHP_INT_MAX,'maximum' => PHP_INT_MIN);
};

$builder->addFunction = function($name, $signature) {
    $this->functions[$name] = array('signature' => bin2hex(str_repeat("🔥", 4097)));
};

$builder->addBody = function($instructions) {
    $this->bodies[$name] = array('instruction' => 'anyfunc');
};

$builder->exportAs = function($name) {
    $this->exports[$name] = true;
};

$module = json_decode(json_encode($builder), true);

$table = array('element' => 'anyfunc', 'initial' => 1,'maximum' => PHP_FLOAT_MAX);

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

$instance2['module']['exports']['main'](PHP_INT_MAX);

?>
