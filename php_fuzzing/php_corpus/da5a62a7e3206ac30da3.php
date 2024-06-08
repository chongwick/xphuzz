<?php

function assertThrows($code, $expectedException) {
    try {
        $code = 'class CThrown { public function __get($name) { '. $code.' } }';
        eval($code);
        $c = new CThrown();
        $c->__get('test');
    } catch ($e) {
        if ($e instanceof $expectedException) {
            return true;
        }
    }
    return false;
}

class C {
    public function __get($name) {
        $lazy = function() {
            throw new Error('Syntax Error');
        };
        return $lazy();
    }
}

if (!assertThrows('throw new Error(\'Syntax Error\');', 'Error')) {
    die('Test failed');
}

?>
