<?php
class WasmModuleBuilder {
    private $functions = [];
    private $currentFunction = null;

    public function addFunction($name, $sig) {
        $this->currentFunction = ['name' => $name,'sig' => $sig, 'body' => []];
        $this->functions[] = $this->currentFunction;
    }

    public function addBody($body) {
        if ($this->currentFunction) {
            $this->currentFunction['body'] = array_merge($this->currentFunction['body'], $body);
        }
    }

    public function exportFunc() {
        // implementation omitted
    }

    public function toBuffer($debug) {
        // implementation omitted
    }
}

?>