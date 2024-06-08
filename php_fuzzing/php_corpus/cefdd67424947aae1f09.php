<?php

require_once 'WasmModuleBuilder.php';
require_once 'WasmConstants.php';

class WasmModuleBuilder {
    public function __construct() {
        // Constructor implementation
    }

    public function addMemory($initial, $maximum, $shared) {
        // Implementation for addMemory method
    }

    public function addFunction($name, $signature) {
        // Implementation for addFunction method
    }

    public function addBodyWithEnd($body) {
        // Implementation for addBodyWithEnd method
    }

    public function exportFunc() {
        // Implementation for exportFunc method
    }

    public function instantiate() {
        // Implementation for instantiate method
    }
}

$builder = new WasmModuleBuilder();
$builder->addMemory(16, 32, false);
$builder->addFunction("test", "i(iii)")
    ->addBodyWithEnd([
        WasmConstants::EXPR_GET_LOCAL, 0,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 0,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 1,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 1,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 0,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 1,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 1,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 0,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 0,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_GET_LOCAL, 1,
        WasmConstants::EXPR_GROW_MEMORY, 0,
        WasmConstants::EXPR_I32_STORE_MEM16, 0, 255, 255, 63,
        WasmConstants::EXPR_UNRE
