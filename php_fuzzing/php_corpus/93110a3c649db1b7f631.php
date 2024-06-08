<?php

// Copyright 2020 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --experimental-wasm-simd

require_once __DIR__. '/wasm-module-builder.php'; // specify the relative path

$builder = new WasmModuleBuilder();
$builder->addMemory(16, 32, false);
$builder->addType(makeSig([], [WasmType::I32()]));
// Generate function 1 (out of 1).
$builder->addFunction(null, 0 /* sig */)
  ->addBodyWithEnd([
    // signature: i_v
    // body:
    WasmExpr::I32Const(0x00),  // i32.const
    WasmExpr::SimdPrefix(WasmExpr::I16x8Load8x8U, 0x03, 0xff, 0xff, 0x3f),  // i16x8.load8x8_u
    WasmExpr::SimdPrefix(WasmExpr::I16x8ExtractLaneS, 0),
    WasmExpr::End,  // end @371
  ])
  ->exportAs('main');
$instance = $builder->instantiate();
assertTraps(kTrapMemOutOfBounds, function() use ($instance) {
  return $instance->exports->main();
});

?>
