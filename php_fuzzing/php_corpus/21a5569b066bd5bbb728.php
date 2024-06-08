<?php

require_once __DIR__. '/wasm-constants.php';
require_once __DIR__. '/wasm-module-builder.php';

function makeSig($types, $rets) {
    // implement makeSig function
}

function wasmModuleBuilder() {
    $builder = new WasmModuleBuilder();
    $builder->addType(makeSig([], []));
    $builder->addType(makeSig([kWasmI32], [kWasmI32]));
    $builder->addFunction(null, 0)
        ->addBodyWithEnd([
            'kExprEnd',   // @1
        ]);
    $builder->addFunction(null, 1)
        ->addLocals(['i32_count' => 65])
        ->addBodyWithEnd([
            'kExprLoop', 'kWasmStmt',   // @3
            'kSimdPrefix',
            'kExprF32x4Min',
            'kExprI64UConvertI32',
            'kExprI64RemS',
            'kExprUnreachable',
            'kExprLoop', 0x02,   // @10
        ]);
}

wasmModuleBuilder();

?>
