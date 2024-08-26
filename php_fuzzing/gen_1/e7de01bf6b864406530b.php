<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
    // implement methods...
}

class WasmModule {
    private $builder;

    public function __construct(WasmModuleBuilder $builder) {
        $this->builder = $builder;
    }

    public function getBuilder() {
        return $this->builder;
    }
}

$builder = new WasmModuleBuilder();
$wasm = new WasmModule($builder);
$wasm->getBuilder()->addMemory(PHP_INT_MAX, 1, false, true);
$wasm->getBuilder()->addGlobal('i64', PHP_INT_MIN);
$wasm->getBuilder()->addType(['f32', 'f64'], ['f32']);
$wasm->getBuilder()->addFunction(null, $wasm->getBuilder()->addType(['f32', 'f64'], ['f64']))
    ->addLocals(['i32_count' => 100000000])
    ->addLocals(['i64_count' => PHP_INT_MIN])
    ->addBodyWithEnd(<<<EOT
        // signature: f_illl
        // body:
        kExprLocalGet, 0x1b
        kExprLocalSet, 0x1c
        kExprF64Const, 3.14159265359
        kExprIf
EOT
);

?>
