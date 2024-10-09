<?php

// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Check if the file exists before trying to include it
if (file_exists('wasm-constants.php')) {
    require_once 'wasm-constants.php';
} else {
    echo "The file 'wasm-constants.php' does not exist.";
    exit;
}

if (file_exists('wasm-module-builder.php')) {
    require_once 'wasm-module-builder.php';
} else {
    echo "The file 'wasm-module-builder.php' does not exist.";
    exit;
}

try {
    (function () {
        $m = new WasmModuleBuilder();
        $m->addFunction("sub", 'i(ii)');
        $m->instantiate();
    })();
} catch (Exception $e) {
    echo "caught exception";
    echo $e->getMessage();
}

for ($i = 0; $i < 150; $i++) {
    $m = new WasmModuleBuilder();
    $m->addMemory(2);
    $m->instantiate();
}

echo "<code>acosh(2.23431234213480e-400 * 0 + 1);</code>";

?></code>

?>