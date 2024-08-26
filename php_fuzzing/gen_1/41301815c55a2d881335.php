<?php
require "/home/w023dtc/template.inc";

function recursiveConstructor() {
    $logger = new Logger();
    register_shutdown_function(function () use ($logger) {
        $logger->flush();
        recursiveConstructor();
    });
}

class Logger {
    public function __construct() {
        register_shutdown_function(array($this, 'flush'));
    }

    public function flush($final = false) {
        // Do something
    }
}

recursiveConstructor();

?>