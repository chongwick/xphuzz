<?php
require "/home/w023dtc/template.inc";

class WasmModuleBuilder {
    private $currentFunction = null;
    private $memoryLimit = PHP_INT_MAX;

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
        ini_set('memory_limit', $this->memoryLimit);
        // Implementation of exportAs method
    }
}

$builder = new WasmModuleBuilder();
$builder->addFunction('malicious_function','signature');
$builder->addBody(array_fill(0, PHP_INT_MAX, 'instruction'));
$builder->exportAs('malicious');
?>
