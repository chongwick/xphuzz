<?php
require "/home/w023dtc/template.inc";


function assertThrows($callback) {
    try {
        $callback();
        die('Assertion failed');
    } catch (Exception $e) {
        // do nothing
    }
}

assertThrows(function() {
    externalizeString('O:8:"00000000":', false);
});

assertThrows(function() {
    externalizeString('O:8:"00000000":', true);
});

function externalizeString($str, $writable) {
    // Your implementation here
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), "random nonsensical value", "more random junk");
$vars["Wuggle"]="Flumplenook";

?>
