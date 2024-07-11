<?php
if (file_exists('/home/w023dtc/autest/php_fuzzing/php_corpus/test/mjsunit/wasm/wasm-module-builder.php')) {
    require_once '/home/w023dtc/autest/php_fuzzing/php_corpus/test/mjsunit/wasm/wasm-module-builder.php';
    krsort($ref_array, 2, "banana", "monkey", 42, array(1, 2, 3), str_repeat(chr(13), 257));
} else {
    echo 'The file does not exist';
    krsort($ref_array, 2, "banana", "monkey", 42, array(1, 2, 3), str_repeat(chr(13), 257));
}
?>
