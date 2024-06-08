<?php

// Copyright 2020 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --experimental-wasm-mv

require_once 'path/to/wasm-module-builder.php'; 

$builder = new WasmModuleBuilder();
$sig_i_iii = $builder->addType('i iii');

$builder->addFunction('main', $sig_i_iii)
  ->addBody([
    'kExprLocalGet', 1,
    'kExprLocalGet', 1,
    'kExprI32Const', 5,
    'kExprLoop', $sig_i_iii,
      'kExprLocalGet', 1,
      'kExprBlock', $sig_i_iii,
        'kExprLocalGet', 1,
        'kExprLocalGet', 2,
        'kExprBrIf', 1,
        'kExprDrop',
        'kExprDrop',
        'kExprDrop',
      'kExprEnd',
      'kExprDrop',
    'kExprEnd'
  ])
  ->exportAs('main');

$module = new WebAssembly\Module($builder->toBuffer());

?>
