<?php
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
        // Implementation of exportAs method
    }
}

?>