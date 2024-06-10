<?php

class Base {
}

class Subclass extends Base {
    public function __construct() {
        // ignore the arguments
    }
}

function assertThrows($callable, $expectedException) {
    try {
        $callable();
    } catch (Throwable $e) {
        if ($e instanceof $expectedException) {
            return;
        } else {
            throw new Exception("Expected ". get_class($expectedException). " but got ". get_class($e));
        }
    }
    throw new Exception("Expected ". get_class($expectedException). " but no exception was thrown");
}

function assertThrowsString($callable, $expectedException) {
    try {
        $callable();
    } catch (Throwable $e) {
        if ($e instanceof $expectedException) {
            return;
        } else {
            trigger_error("Expected ". get_class($expectedException). " but got ". get_class($e), E_ERROR);
        }
    }
    trigger_error("Expected ". get_class($expectedException). " but no exception was thrown", E_ERROR);
}

assertThrowsString(function() { new Subclass(); }, \TypeError::class);
assertThrowsString(function() { new Subclass(1); }, \TypeError::class);
assertThrowsString(function() { new Subclass(1, 2); }, \TypeError::class);
assertThrowsString(function() { new Subclass(1, 2, 3); }, \TypeError::class);
assertThrowsString(function() { new Subclass(1, 2, 3, 4); }, \TypeError::class);

assertThrowsString(function() { (new Subclass()); }, \TypeError::class);
assertThrowsString(function() { (new Subclass)(); }, \TypeError::class);
assertThrowsString(function() { (new Subclass)(1); }, \TypeError::class);
assertThrowsString(function() { (new Subclass)(1, 2); }, \TypeError::class);
assertThrowsString(function() { (new Subclass)(1, 2, 3, 4); }, \TypeError::class);

?>
