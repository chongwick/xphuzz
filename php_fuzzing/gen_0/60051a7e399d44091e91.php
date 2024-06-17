<?php
if (file_exists(__DIR__. '/wasm-constants.php')) {
    require_once __DIR__. '/wasm-constants.php';
} else {
    echo "File not found: wasm-constants.php";
}

?>