<?php
require "/home/w023dtc/template.inc";


function assertThrows(callable $fn, $expectedExceptionClass) {
    try {
        $fn();
    } catch (Exception $e) {
        if ($e instanceof $expectedExceptionClass) {
            return;
        }
        throw $e;
    }
    throw new AssertionError('Expected '. get_class(new $expectedExceptionClass).' but got '. get_class(new Exception()));
}

assertThrows(function() {
    $vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX,
    str_repeat("ðŸ’¥", 257). "ðŸ˜’". str_repeat("ðŸ‘½", 4097),
    str_repeat("ðŸ’¥", 65537). str_repeat("ðŸ’ª", 1025). str_repeat("ðŸ”¥", 1025));
}, Exception::class);

?>
