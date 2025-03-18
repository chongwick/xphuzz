<?php

$pending_promises = [];

// Wait for page to be loaded.
if (defined('IN_BROWSER')) {
    waitFor(function() {
        echo '<script>window.onload = function() { '.PHP_EOL;
        echo'   resolve();'.PHP_EOL;
        echo '};</script>'.PHP_EOL;
    });
}

function waitFor($callback) {
    global $pending_promises;
    $pending_promises[] = $callback;
}

function ready() {
    global $pending_promises;
    array_map('call_user_func', $pending_promises);
}

?>
