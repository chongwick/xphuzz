<?php
// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

class WasmModuleBuilder {
    private $functions = [];

    public function addImportedTable($name, $table, $initial, $maximum, $type) {
        // Implement the method
    }

    public function addFunction($name, $signature) {
        $this->functions[$name] = $signature;
        return $this;
    }

    public function exportFunc($name) {
        if (isset($this->functions[$name])) {
            // Implement the method
        } else {
            throw new Exception("Function '$name' does not exist");
        }
    }

    public function toModule() {
        // Implement the method
    }
}

class WebAssembly {
    public static function Table($element, $initial, $maximum) {
        // Implement the method
    }

    public static function Instance($module, $imports) {
        $instance = new stdClass();
        $instance->exports = new stdClass();
        return $instance;
    }
}

$vars = [];
$vars["ReflectionType"] = new ReflectionClass("ReflectionType");
$vars["ReflectionType"]->getMethods()[mt_rand(0, count($vars["ReflectionType"]->getMethods()))]->invoke($vars["ReflectionType"]->getDeclaringClass()->newInstanceWithoutConstructor(), "toString", "notReallyToString");

$builder = new WasmModuleBuilder();
$builder->addImportedTable('ffi', 't1', 5, 5, 'anyfunc');
$builder->addImportedTable('ffi', 't2', 9, 9, 'anyfunc');

$builder->addFunction('foo', 'v_v')->exportFunc('foo');

$module = $builder->toModule();
$table1 = WebAssembly::Table('anyfunc', 5, 5);
$table2 = WebAssembly::Table('anyfunc', 9, 9);

$instance = WebAssembly::Instance($module, ['ffi' => ['t1' => $table1, 't2' => $table2]]);
$table3 = WebAssembly::Table('anyfunc', 9, 9);
$instance->exports->foo = $table3;
WebAssembly::Instance($module, ['ffi' => ['t1' => $table1, 't2' => $table3]]);
</code>
