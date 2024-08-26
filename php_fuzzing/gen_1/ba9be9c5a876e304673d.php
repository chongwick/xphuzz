<?php
require "/home/w023dtc/template.inc";


function __f_3($f) {
  $args = func_get_args();
  $args[0]->length = $f;
  return $args;
}

function __f_4() {
  return (object) array(
   'stdClass' => new stdClass(),
    'float_max' => PHP_FLOAT_MAX,
    'float_min' => PHP_FLOAT_MIN,
    'int_max' => PHP_INT_MAX,
    'int_min' => PHP_INT_MIN
  );
}

$v4 = array();
$v13 = "";

for ($i = 0; $i < 12800; $i++) {
  $v4 = (object)__f_3(__f_4());
  $v13.= get_class_methods(get_class($v4));
  $v13.= bin2hex(str_repeat(chr(PHP_INT_MAX), 257) ^ $v4->float_max). "\n";
  $v13.= bin2hex(str_repeat(chr(PHP_INT_MIN), 257) ^ $v4->float_min). "\n";
}

echo $v13;

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257) ^ $this->func(), 
bin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097) ^ $v4->float_max), 
bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)) ^ 0xdeadbeef);

?>
