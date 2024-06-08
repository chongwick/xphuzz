<?php

class WasmModuleBuilder {
    public function addType($type) {
        // implement addType method
    }

    public function addFunction($name, $sig) {
        $body = [];
        // implement addBody method
        return $this;
    }

    public function addBody(array $body) {
        // implement addBody method
        $this->body = $body;
        return $this;
    }

    public function exportFunc($name) {
        // implement exportFunc method
    }

    public function addTable($type, $min, $max) {
        // implement addTable method
    }

    public function addMemory($initial, $maximum, $shared, $mappable) {
        // implement addMemory method
    }

    public function toBuffer() {
        // implement toBuffer method
    }
}

class WebAssembly {
    public static function Module($buffer) {
        // implement Module method
    }

    public static function Instance($module) {
        // implement Instance method
    }
}

function makeSig($types, $imports) {
    // implement makeSig function
    return implode(',', $types);
}

function Regress1137608() {
    print("Regress1137608");
    $builder = new WasmModuleBuilder();
    $sig0 = $builder->addType('i32');
    $sig1 = $builder->addType(['f64', 'f64', 'i32', 'i32', 'i32', 'f32', 'i32', 'f64', 'i32', 'f32', 'i32', 'f32', 'i32', 'f64', 'i32']);
    $main = $builder->addFunction('main', $sig0)
        ->addBody([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
