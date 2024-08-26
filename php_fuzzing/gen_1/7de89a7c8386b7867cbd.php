<?php
require "/home/w023dtc/template.inc";


$vars[PHP_INT_MAX]->addAttribute("This should totally work... maybe?", PHP_INT_MIN, "This value is totally legit... or not?", PHP_FLOAT_MAX, "I hope this doesn't break anything...");
if (!file_exists('test/mjsunit/wasm/wasm-constants.php')) {
    echo "File 'test/mjsunit/wasm/wasm-constants.php' does not exist.";
    exit;
}

require_once 'test/mjsunit/wasm/wasm-constants.php';
require_once 'test/mjsunit/wasm/wasm-module-builder.php';

$builder = new WasmModuleBuilder();
$builder->addFunction('', 'v_v')->addBody([]);
$builder->addFunction('', 'i_i')
  ->addBody([
    'ExprGetLocal', 0,
    'ExprGetLocal', 0,
    // Stack now contains two copies of the first param register.
    // Start a loop to create a merge point (values still in registers).
    'ExprLoop', 'WasmStmt',
      // The call spills all values.
      'ExprCallFunction', 0,
      // Break to the loop. Now the spilled values need to be loaded back *into
      // the same register*.
      'ExprBr', 0,
      'ExprEnd',
    'ExprDrop'
]);
$builder->instantiate();

?>
