<?php
require "/home/w023dtc/template.inc";


class BigInt64Array {
  private $buffer;

  public function __construct($size) {
    $this->buffer = str_repeat("\0", $size * 8);
  }

  public function getBuffer() {
    return $this->buffer;
  }

  public static function of($array, $evil_object) {
    return call_user_func_array(array($evil_object, '__toString'), array($array->getBuffer()));
  }
}

class EvilObject {
  public function __toString() {
    // equivalent of %ArrayBufferNeuter(array.buffer);
    $buffer = str_split(unpack('H*', $GLOBALS['array']->getBuffer())[1], 1);
    array_walk($buffer, function(&$v) { $v = 0; });
    gc_collect_cycles();
    return PHP_INT_MAX - 16; // rax: 0x7fffffff
  }
}

$evil_object = new EvilObject();

$GLOBALS['array'] = new BigInt64Array(PHP_INT_MAX);

$GLOBALS['root'] = BigInt64Array::of($GLOBALS['array'], $evil_object);

gc_collect_cycles(); // trigger

?>
