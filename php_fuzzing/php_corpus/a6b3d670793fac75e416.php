<?php

// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --wasm-lazy-compilation

require_once './wasm-constants.php'; 
require_once './wasm-module-builder.php'; 

function ExportedFunctionsImportedOrder() {
  echo __FUNCTION__. "\n";

  $i1 = instantiateWasmModule();
  $i2 = instantiateWasmModuleWithImports($i1);

  echo "--->calling 0\n";
  assertEquals(2, $i2->main(0));
  echo "--->calling 1\n";
  assertEquals(1, $i2->main(1));
  echo "--->calling 2\n";
  assertEquals(1, $i2->main(2));
  echo "--->calling 3\n";
  assertEquals(2, $i2->main(3));
}

function instantiateWasmModule() {
  $builder = new WasmModuleBuilder();
  $builder->addFunction("f1", "i(v)")
    ->addBody([
      "exprI32Const",
      1
    ])
    ->exportFunc();
  $builder->addFunction("f2", "i(v)")
    ->addBody([
      "exprI32Const",
      2
    ])
    ->exportFunc();
  return $builder->instantiate();
}

function instantiateWasmModuleWithImports($i1) {
  $builder = new WasmModuleBuilder();
  $builder->addImport("q", "f2", "i(v)");
  $builder->addImport("q", "f1", "i(v)");
  $builder->addFunction("main", "i(i)")
    ->addBody([
      "getLocal",
      0,
      "callIndirect",
      0,
      "tableZero"
    ])
    ->exportFunc();
  $builder->addFunctionTableInit(0, false, [0, 1, 1, 0]);

  return $builder->instantiate(array(
    "q" => array(
      "f2" => $i1->exports->f2,
      "f1
