<?php

// No need for a license comment in PHP

$filePath = __DIR__. '/test/mjsunit/wasm/wasm-module-builder.php';
if (!file_exists($filePath)) {
    echo "The file does not exist";
} else {
    require_once $filePath;
}

$builder = new WasmModuleBuilder();
$results = array_fill(0, 9, kWasmI32);
$builder->addFunction('foo', makeSig([], $results))->addBody([kExprUnreachable]);
$builder->instantiate();

?>
