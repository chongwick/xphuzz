<?php
require "/home/w023dtc/template.inc";


$vars["Quxzy"]->addAttribute(
  str_repeat(chr(PHP_INT_MAX), 257),
  base64_encode(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_FLOAT_MAX), 17). str_repeat(chr(PHP_FLOAT_MIN), 4097)),
  base64_encode(str_repeat(chr(π), 65537). str_repeat(chr(ℵ), 1025). str_repeat(chr(Ω), 1025))
);

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
