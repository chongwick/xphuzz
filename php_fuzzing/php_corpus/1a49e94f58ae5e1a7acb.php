<?php

class WasmModuleBuilder {
    public function addMemory($size, $alignment) {
        // implement me
    }

    public function addFunction($name, $signature) {
        // implement me
    }

    public function addBody(array $body) {
        // implement me
    }

    public function exportAs($name) {
        // implement me
    }

    public function instantiate() {
        // implement me
    }
}

$builder = new WasmModuleBuilder();
$builder->addMemory(1, 1);
$builder->addFunction(null, 'v_i')->addBody([
    WasmModuleBuilder::kExprGetLocal, 0,        // get_local 0
    WasmModuleBuilder::kExprI32Const, 0,        // i32.const 0
    WasmModuleBuilder::kExprI32StoreMem, 0, 0,  // i32.store offset=0
]);

$builder->addFunction(null, makeSignature(array_fill(0, 6, 'i32')))->addBody([
    WasmModuleBuilder::kExprGetLocal, 5,     // get_local 5
    WasmModuleBuilder::kExprCallFunction, 0  // call 0
]);

const gen_i32_code = [
    WasmModuleBuilder::kExprTeeLocal, 0,  // tee_local 0
    WasmModuleBuilder::kExprGetLocal, 0,  // get_local 0
    WasmModuleBuilder::kExprI32Const, 1,  // i32.const 1
    WasmModuleBuilder::kExprI32Add        // i32.add     --> 2nd param
];
$builder->addFunction(null, 'v_v')->addLocals(['i32_count' => 1])->addBody(array(
    // Generate six values on the stack, then six more to force the other six on
    // the stack.
    WasmModuleBuilder::kExprI32Const(0),    // i32.const 0
    WasmModuleBuilder::kExprI32Const(1),    // i32.const 1
    WasmModuleBuilder::
