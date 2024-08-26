<?php
require "/home/w023dtc/template.inc";


function assertThrows(callable $callback, $expectedException) {
    try {
        $callback();
        throw new Exception("Expected exception of type $expectedException, but no exception was thrown");
    } catch (TypeError $e) {
        return;
    } catch (Exception $e) {
        throw new Exception("Expected exception of type $expectedException, but got $e");
    }
}

assertThrows(function() {
    $vars["SimpleXMLElement"]->addAttribute(PHP_INT_MAX, 
        str_repeat(chr(13), 257).str_repeat(chr(193), 257).str_repeat(chr(155), 17).str_repeat(chr(147), 4097).str_repeat(chr(161), 65537).str_repeat(chr(213), 1025).str_repeat(chr(214), 1025).str_repeat(chr(2.23431234213480e-400), 1000000));
}, 'TypeError');

?>
