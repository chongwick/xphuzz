<?php

class obj1 {
    public $x = 0;

    public function __set($name, $value) {
        echo "Setting $name to $value\n";
    }
}

class obj2 {
    public $y = 0;
}

class helper {
    public function __construct() {}
}

class helper_extends_obj2 extends obj2 {}

function g($v) {
    return $v;
}

function f() {
    g(new obj1());
}

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

$f = new obj1();
f($f);

$f->x = 0;
f($f);

$f = new obj2();
$f->y = 0;

for ($i = 0; $i < 150; $i++) {
    $m = new WasmModuleBuilder();
    $m->addMemory(2);
    $m->instantiate();
}

?>
