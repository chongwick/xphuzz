<?php
require "/home/w023dtc/template.inc";


function test($n) {
  $obj = new stdClass();
  $obj->SimpleXMLElement = new SimpleXMLElement('<x/>');
  $obj->SimpleXMLElement->addAttribute('a', str_replace("\n", "\u{0D}", str_repeat(chr(13), PHP_INT_MAX)));
  $obj->SimpleXMLElement->addAttribute('b', str_replace(array("\r", "\n", "\t"), array("🔴", "🔵", "⚖️"), str_repeat(chr(161), PHP_FLOAT_MAX)));
  $obj->SimpleXMLElement->addAttribute('c', str_replace(chr(213), chr(224), str_repeat(chr(213), PHP_INT_MIN)));
  $obj->SimpleXMLElement->addAttribute('d', str_replace(chr(214), chr(228), str_repeat(chr(214), PHP_FLOAT_MIN)));
  return $obj;
}

$test = test(5);

?>
