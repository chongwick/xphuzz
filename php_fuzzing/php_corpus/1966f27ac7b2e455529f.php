<?php

// Define constants
const kWasmI64 = 'i64';
const kWasmI32 = 'i32';

// Create a builder instance
class WasmModuleBuilder {
    private $module;

    public function __construct() {
        $this->module = new \WasmModule(); // Import the WasmModule class
    }

    public function addMemory($initial, $maximum, $shared, $writable) {
        $this->module->addMemory($initial, $maximum, $shared, $writable);
    }

    public function addFunction($name, $sig) {
        $this->module->addFunction($name, $sig);
    }

    public function addExport($name, $index) {
        $this->module->addExport($name, $index);
    }

    public function instantiate() {
        return new \WasmInstance($this->module);
    }

    public function getModule() {
        return $this->module;
    }
}

// Create a builder instance
$builder = new WasmModuleBuilder();

// Add memory
$builder->addMemory(16, 32, false, true);

// Define a type signature
function makeSig($types) {
    return implode('', $types);
}

// Add a function
$sig = makeSig([
    kWasmI64,
    kWasmI32,
    kWasmI64,
    kWasmI32,
    kWasmI32,
    kWasmI32,
    kWasmI32,
    kWasmI32,
    kWasmI64,
    kWasmI64,
    kWasmI64
]);

$builder->addFunction('main', $sig)
    ->addLocals(['f32_count' => 10])
    ->addLocals(['i32_count' => 4])
    ->addLocals(['f64_count' => 1])
    ->addLocals(['i32_count' => 15])
    ->addBody([
        'i32.const', 0,
        'i64.const', 0,

