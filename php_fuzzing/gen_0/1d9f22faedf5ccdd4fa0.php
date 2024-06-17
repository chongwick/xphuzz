<?php

class WasmModuleBuilder {
    public function addMemory($size, $alignment, $shared, $writable) {
        // implement addMemory method
    }

    public function addGlobal($type, $init) {
        // implement addGlobal method
    }

    public function addType($sig) {
        // implement addType method
    }

    public function addFunction($name, $sig) {
        $function = $this;
        return new class($function) {
            private $function;

            public function __construct($function) {
                $this->function = $function;
            }

            public function addLocals($locals) {
                $this->function->addLocals($locals);
                return $this;
            }

            public function addBodyWithEnd($body) {
                $this->function->addBodyWithEnd($body);
                return $this;
            }

            public function __toString() {
                return '';
            }
        };
    }

    public function addLocals($locals) {
        // implement addLocals method
    }

    public function addBodyWithEnd($body) {
        // implement addBodyWithEnd method
    }

    public function instantiate() {
        // implement instantiate method
    }
}

$builder = new WasmModuleBuilder();
$builder->addMemory(1, 1, false, true);
$builder->addGlobal('i32', 1);
$sig = $builder->addType(['i32', 'i64', 'i64', 'i64'], ['f32']);
$builder->addFunction(null, $sig)
    ->addLocals(['i32_count' => 57])
    ->addLocals(['i64_count' => 11])
    ->addBodyWithEnd(<<<EOT
        // signature: f_illl
        // body:
        kExprLocalGet, 0x1b
        kExprLocalSet, 0x1c
        kExprI32Const, 0x00
        kExprIf
EOT
);
