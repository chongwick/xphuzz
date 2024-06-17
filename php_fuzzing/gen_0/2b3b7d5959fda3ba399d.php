<?php

try {
    // No equivalent to Wasm.instantiateModuleFromAsm in PHP
    throw new Exception();
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

?>
