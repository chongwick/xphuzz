<?php

require_once __DIR__. '/vendor/autoload.php';

use WebAssembly\Module;
use WebAssembly\Table;
use WebAssembly\Instance;

class WasmModuleBuilder {
    public function addImportedTable($name, $type) {
        // Implement this method
    }

    public function addImportedGlobal($name, $type, $initialValue) {
        // Implement this method
    }

    public function addImport($name, $type, $signature) {
        // Implement this method
    }

    public function addType($signature) {
        // Implement this method
    }

    public function addFunctionTableInit($global, $init, $functions) {
        // Implement this method
    }

    public function toBuffer() {
        // Implement this method
    }
}

$builder = new WasmModuleBuilder();
$q_table = $builder->addImportedTable("q", "table");
$q_base = $builder->addImportedGlobal("q", "base", 0);
$q_fun = $builder->addImport("q", "fun", "v_v");
$builder->addType
