<?php

class WasmModuleBuilder {
    public function addMemory($size, $align, $isShared, $isExported) {
        // TO DO: implement addMemory method
    }

    public function addFunction($name, $signature) {
        // TO DO: implement addFunction method
    }

    public function addLocals($type, $count) {
        // TO DO: implement addLocals method
    }

    public function addBodyWithEnd($body) {
        // TO DO: implement addBodyWithEnd method
    }

    public function addExport($name, $index) {
        // TO DO: implement addExport method
    }

    public function instantiate() {
        // TO DO: implement instantiate method
    }
}

$builder = new WasmModuleBuilder();
$builder->addMemory(16, 32, false, true);
// Generate function 1 (out of 1).
$builder->addFunction(null, 'i_v')
    ->addLocals('WasmI64', 1)
    ->addBodyWithEnd(array(
        // signature: i_v
        // body:
        'i32.const', 0x00,  // i32.const
        'i32.const', 0x00,  // i32.const
        'i32.const', 0x00,  // i32.const
   'select', 0x01, 0x7f,  // select
   'memory.grow', 0x00,  // memory.grow
        'i32.const', 0xb0, 0xde, 0xc9, 0x03,  // i32.const
        'i8x16.splat',  // i8x16.splat
        'i32.const', 0x00,  // i32.const
        'i8x16.splat',  // i8x16.splat
        'i32.const', 0xb0, 0xe0, 0xc0, 0x01,  // i32.const
        'i8x16.splat',  // i8x16.splat
        'i64x2.extmul_high_i32x4_u
