<?php

// This is a fuzzer-generated test case that exposed a bug in Liftoff that only
// affects ARM, where the fp register aliasing is different from other archs.
// We were inncorrectly clearing the the high fp register in a LiftoffRegList
// indicating registers to load, hitting a DCHECK.

// Load the WasmModuleBuilder class
require 'test/mjsunit/wasm/wasm-module-builder.php';

// Create a new WasmModuleBuilder instance
$builder = new WasmModuleBuilder();

// Add memory to the builder
$builder->addMemory(19, 32, false);

// Add a global variable
$builder->addGlobal('kWasmI32', 0);

// Add a type
$builder->addType(makeSig([], []));

// Add another type
$builder->addType(makeSig([kWasmI64, kWasmS128, kWasmF32], [kWasmI32
