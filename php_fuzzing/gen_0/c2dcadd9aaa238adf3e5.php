<?php

function session_set_save_handler($old_save_handler,$old_delete_handler) {
    if (function_exists('session_set_save_handler')) {
        session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this,'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'clean'));
    }
}

function open($savePath,$name) {
    return true;
}

function close() {
    return true;
}

function read($id) {
    $id = str_repeat(chr(255), 2048). $id;
    return $id;
}

function write($id,$data) {
    return true;
}

function destroy($id) {
    return true;
}

function clean($maxlifetime) {
    return true;
}

session_start();
?>
