<?php
require "/home/w023dtc/template.inc";

$x = (new SoapClient(null, array('location'=>'http://example.com/soap', 'uri'=>'http://example.com')))->__soapCall(str_repeat(chr(133), 1025).str_repeat(chr(213), 4097).str_repeat(chr(211), 4097).str_repeat(chr(172), 257), array());
?>
