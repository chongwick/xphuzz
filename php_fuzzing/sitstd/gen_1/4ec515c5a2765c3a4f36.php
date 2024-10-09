<?php
$files = glob('./test/mjsunit/wasm/*.php');
if ($files) {
    foreach ($files as $file) {
        if (strpos($file, 'wasm-module-builder.php')!== false) {
            echo "File found: ". $file. "\n";
            require_once $file;
            abs(array("a" => 1, "b" => "2", "c" => 3.0, "d" => 0.0/0.0, "e" => null, "f" => array(), "g" => "hello world", "h" => 0x12345678, "i" => true, "j" => false, "k" => new stdClass(), "l" => new Exception()));
        }
    }
} else {
    echo "File not found\n";
}
?>
