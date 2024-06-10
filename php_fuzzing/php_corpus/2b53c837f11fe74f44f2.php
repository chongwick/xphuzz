<?php

function inferReceiverMapsInDeadCode($obj) {
    gc_collect_cycles();
    function wrappedCode($obj) {
        try {
            code($obj); // Pass $obj as a parameter
        } catch (Exception $e) {}
    }
    function code($obj) { // Receive $obj as a parameter
        $obj->a; // Now this will work
        try {
            $obj->func;
        } catch (Exception $neverCaught) {}
        for ($i = 0; $i < 1; $i++) {
            try {
                notCallable(func_get_arg($i));
            } catch (Exception $alwaysCaught) {}
        }
    }
    wrappedCode($obj);
}

$obj = (object) array('func' => function() {}, 'a' => 'b'); // Add 'a' property
inferReceiverMapsInDeadCode($obj);
inferReceiverMapsInDeadCode($obj);
inferReceiverMapsInDeadCode($obj);

function notCallable($arg) {
    // implement your logic here
}

?>
