<?php

class CustomTypeError extends TypeError {
    public function __construct($message, $string) {
        parent::__construct($message, E_ERROR);
    }
}

function assertThrows($code, $expectedException) {
    try {
        $code();
        throw new AssertionError('Expected exception of type '. get_class($expectedException).'but none was thrown.');
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError('Expected exception of type '. get_class($expectedException).'but got '. get_class($e).' instead.');
        }
    }
}

assertThrows(function() {
    throw new CustomTypeError('Test', 'int is not a string');
}, CustomTypeError::class);

?>
