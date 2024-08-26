<?php
require "/home/w023dtc/template.inc";

class MySessionHandler {
    public static function handler($id) {
        echo serialize(array());
        return false;
    }
}

register_tick_function(function() {
    $a = array();
    for ($i = 0; $i < 1000000; $i++) {
        $a[] = 1;
    }
});

register_shutdown_function(function() {
    var_dump($b);
});

session_set_save_handler(array("MySessionHandler", "handler"));
session_start();
