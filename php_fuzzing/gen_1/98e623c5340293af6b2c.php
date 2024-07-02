<?php
<code>
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

$vars["DateInterval"]->format(implode(array_map(function($c) {
    return chr(hex2bin(str_pad(dechex($c), 2, "0")));
}, array_reverse(range(0, 255))))). chr(0x1F). chr(0x9C). chr(0x82). chr(0x1F). chr(0x9C). chr(0x82);

?>
</code>

?>