<?php

require_once 'PHPUnit/Autoload.php';

class Proxy {
    private $target;

    public function __construct($target, $o) {
        $this->target = $target;
    }

    public function __get($name) {
        return $this->target->$name;
    }

    public function __set($name, $value) {
        $this->target->$name = $value;
    }
}

try {
    $o = new stdClass();
    $p = new Proxy($o, $o);
    set_error_handler(function($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    });
    trigger_error('Cannot pass private property name to proxy trap', E_USER_ERROR);
} catch (ErrorException $e) {
    \PHPUnit\Framework\Assert::assertEquals('Cannot pass private property name to proxy trap', $e->getMessage());
}

?>
