<?php

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

class kWasmF32 {
    // Implement me!
}

class kWasmI32 {
    // Implement me!
}

class kWasmI64 {
    // Implement me!
}

class kWasmStmt {
    // Implement me!
}

class WasmModuleBuilder {
    public function addType($signature) {
        // Implement me!
    }

    public function addFunction($name, $signature) {
        // Implement me!
    }

    public function addBody($body) {
        // Implement me!
    }

    public function instantiate() {
        // Implement me!
    }
}

$builder = new WasmModuleBuilder();
$sig0 = $builder->addType(array(kWasmF32, array(kWasmI32)));
$sig1 = $builder->addType(array(kWasmI64, kWasmI32, kWasmI64, kWasmF32, kWasmI64), array(kWasmF32));
$sig2 = $builder->addType(array(kWasmF32), array(kWasmF32));

$builder->addFunction(null, $sig0)->addBody(array(0x00));
$builder->addFunction(null, $sig1)->addBody(array(
    'kExprBlock' => kWasmF32,   // @1 f32
    0x00,
    'kExprIf' => kWasmStmt,   // @5
        'kExprLoop' => kWasmStmt,   // @7
            'kExprBlock' => kWasmI32,   // @9 i32
                0x00, 0x00, 0x80, 0xc1,
                0x00, 0x00, 0x80, 0x45,
                0x00, // function #0: i_f
                0x03,   // depth=3
                'kExprDrop',
                0xd8, 0x00
