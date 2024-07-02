<?php

class WasmModuleBuilder {
    public $arr = array();
    public $arr[1000] = 0x1234;

    public function __get($key) {
        if ($key === 256) {
            unset($this->arr[$key]);
            array_unshift($this->arr, 1.1);
            $this->arr = array();
        }
        return null;
    }

    public function addGlobal($name, $value) {
        // Add global variable implementation
    }

    public function addType($signature) {
        // Add type implementation
    }

    public function addFunction($name, $type) {
        // Add function implementation
    }

    public function addLocals($locals) {
        // Add locals implementation
    }

    public function addBody($body) {
        // Add body implementation
    }

    public function instantiate() {
        // Instantiate the module implementation
        print_r($this->arr);
    }
}

?>
