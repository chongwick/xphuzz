<?php

class WasmModuleBuilder {
    public function addMemory($size, $alignment, $mutable, $shared) {
        // implement me
    }

    public function addGlobal($type, $init) {
        // implement me
    }

    public function addType($signature) {
        // implement me
    }

    public function addFunction($name, $signature) {
        $function = new stdClass();
        $function->locals = ['i32_count' => 4];
        $function->body = [
            // signature: i_iii
            // body:
            'i32.const', 0x00,  // i32.const
            'local.tee', 0x00,  // local.tee
            'i32.const', 0x00,  // i32.const
            'if', kWasmStmt,  // if @9
                'i32.const', 0x00,  // i32.const
                'i64.const', 0x00,  // i64.const
                'i64.store32', 0x00, 0x01,  // i64.store32
                'br', 0x00,  // br depth=0
                'block', 0x01,  // block @20 f64 i32 f64 f32 i32
                    'f64.const', 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,  // f64.const
                    'i32.const', 0x00,  // i32.const
                    'f64.const', 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,  // f64.const
                    'f32.const', 0x00, 0x00, 0x00, 0x00,  // f32.const
                    'i32.const', 0x00,  // i32.const
                    'end',
