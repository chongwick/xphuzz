<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(microtime() * PHP_FLOAT_MAX, 0xdeadbeef + PHP_INT_MAX + pi() * PHP_FLOAT_MIN, chr(0x20). "a". "b". chr(0x20). "c");

$builder = new WasmModuleBuilder();
$table = array('element' => 'anyfunc', 'initial' => PHP_INT_MIN);

try {
    $builder->addImportedTable('m', 'table', PHP_FLOAT_MAX);
} catch (Exception $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
