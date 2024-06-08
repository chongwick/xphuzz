<?php

// Load necessary files
require_once '/path/to/actual/location/wasm-constants.php';
require_once '/path/to/actual/location/wasm-module-builder.php';

// Create a new WasmModuleBuilder
$builder = new WasmModuleBuilder();

// Define the function signature
$sig = $builder->addType(makeSig([kWasmI32, kWasmI32, kWasmI32], [kWasmI64]));
$sig = $builder->addFunction('main', $sig);

// Add the function body
$sig->addBody([kExprI64Const, 1, kExprI64SExtendI8]);

// Instantiate the module
$builder->instantiate();

?>
