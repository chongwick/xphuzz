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
?>
