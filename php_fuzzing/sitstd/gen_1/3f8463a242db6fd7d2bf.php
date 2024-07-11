<?php

function __f_3($f) {
  $args = func_get_args();
  $args[0]->length = $f;
  return $args;
}

function __f_4() {
  return (object) array();
}

$v4 = array();
$v13 = "";

for ($i = 0; $i < 12800; $i++) {
  $v4 = (object)__f_3(__f_4());
  $v13.= get_class_methods(get_class($v4));
}

// Copyright 2020 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Note: PHP does not have a direct equivalent to WebAssembly, so we'll simulate the behavior

class WasmModuleBuilder {
    public function addImportedTable($name, $importedTable, $size) {
        // Simulate adding an imported table
        echo "Added imported table $name with size $size\n";
    }

    public function instantiate($module) {
        // Simulate instantiating the module
        echo "Instantiating module\n";
        // Check if the table size is too large
        if ($module['m']['table'] > PHP_INT_MAX) {
            throw new Exception("Table size is too large");
        }
    }
}

// Create a new WasmModuleBuilder instance
$builder = new WasmModuleBuilder();

// Create a table
$table = array('element' => 'anyfunc', 'initial' => 2);

// Try to add a large table to the builder
try {
    $builder->addImportedTable('m', 'table', 4000000000);
} catch (Exception $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
