<?php
require "/home/w023dtc/template.inc";


function testFunction() {
    $value = PHP_INT_MAX;
    if ($value <= 4294967295) {
        $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
        str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097),
        str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025).'ðŸŽ‰');
    }
    return array('testFunction' => function() use (&$value) {
        global $value;
        $value = PHP_INT_MIN;
        if($value <= 4294967295) {
            // do something
        }
    });
}

$result = testFunction();
print_r($result);

?>
