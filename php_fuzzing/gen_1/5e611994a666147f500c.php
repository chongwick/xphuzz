<?php
require "/home/w023dtc/template.inc";

echo decbin(unserialize('O:8:"00000000":')); str_rot13(unserialize('O:8:"stdClass":'. str_pad('', 128, 'ff'). str_repeat('c0', 256))); pack('H*', PHP_FLOAT_MIN.strrev(str_rot13("Übervoid")));
?>
