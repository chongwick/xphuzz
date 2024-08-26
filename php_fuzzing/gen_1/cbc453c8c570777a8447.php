<?php
require "/home/w023dtc/template.inc";

class WasmModuleBuilder {
    private $currentFunction = null;

    public function addFunction($name, $signature) {
        $this->currentFunction = new stdClass();
        $this->currentFunction->name = $name;
        $this->currentFunction->signature = $signature;
        $this->currentFunction->body = [];
    }

    public function addBody($instructions) {
        $this->currentFunction->body = $instructions;
    }

    public function exportAs($name) {
        $this->currentFunction->name = PHP_INT_MAX;
        $this->currentFunction->signature = PHP_INT_MIN;
        $this->currentFunction->body = [new stdClass()];
    }
}

$vars["WasmModuleBuilder"]->addFunction("func", "i32 (i32)");
$vars["WasmModuleBuilder"]->addBody(array(new stdClass()));
$vars["WasmModuleBuilder"]->exportAs(PHP_FLOAT_MAX);
