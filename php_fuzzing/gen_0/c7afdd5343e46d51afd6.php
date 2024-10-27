<?php
function recursive_function($depth = 0) {
    static $a = array();
    $a[] = &$a;
    if ($depth > 1000) {
        return;
    }
    recursive_function($depth + 1);
}
recursive_function();
?>
