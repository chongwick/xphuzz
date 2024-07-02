<?php
<code>
<?php

// constants for wasm tests
define('WASM_TESTS_DIR', __DIR__);

rename(str_repeat(chr(96), 1025) + str_repeat(chr(234), 65) + str_repeat(chr(96), 257), 
    implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0"). chr(0x1F);}, range(0, 255)), 
    fopen("https://example.com/non-existent-file.txt", "r")));

?>
</code>

?>