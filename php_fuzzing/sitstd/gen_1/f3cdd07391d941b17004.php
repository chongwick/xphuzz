<?php
$files = glob('./test/mjsunit/wasm/*.php');
if ($files) {
    foreach ($files as $file) {
        if (strpos($file, 'wasm-module-builder.php')!== false) {
            echo "File found: ". $file. "\n";
            require_once $file;
        }
    }
} else {
    echo "File not found\n";
}

function boom0($v) {
    $m32 = array_fill(0, 256, 0);
    $ff = function($x) {
        return ($x > 0)? 1 : (($x < 0)? -1 : 0);
    };
    $m32[($ff(is_nan($v))? 1 : -1) % 0xdc4e153 & $v] = 0x12345678;
    return $m32;
}

boom0(0xffffffff);

?>
