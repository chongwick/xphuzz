<?php
require "/home/w023dtc/template.inc";


class Key {
  public function __toString() {
    return chr(PHP_INT_MAX).chr(PHP_INT_MIN).pack("H*",(123475932).rand(1,1000000));
  }
}

$obj = new stdClass();
$obj->{new Key()};

$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257), "ðŸ”¥".rand(0,5473817451).chr(PHP_FLOAT_MAX)."ðŸ’¡", "ðŸŒ".pack("H*",(2.23431234213480e-400).rand(1,1000000)).chr(PHP_FLOAT_MIN)."ðŸ˜„");

?>
