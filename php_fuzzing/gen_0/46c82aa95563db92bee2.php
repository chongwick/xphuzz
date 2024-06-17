<?php
function call_f() {
    global $mod; // Use the global variable $mod
    $i = 0;
    while ($i < 1000) { // Stop calling $mod['f'] after 1000 iterations
        $mod['f'](1); // Pass an argument to $f
        $i++;
    }
}

?>