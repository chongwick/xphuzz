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
    $buffer = str_split(unpack('H*', $GLOBALS['array']->getBuffer())[1], 1);
    array_walk($buffer, function(&$v) use ($GLOBALS['float_max']) { $v = $GLOBALS['float_max']; });
    gc_collect_cycles();
    return PHP_INT_MIN;
  }
}

class GiantObject {
  public function __toString() {
    return str_repeat('a', PHP_INT_MAX);
  }
}

$GLOBALS['array'] = new BigInt64Array(11);

$GLOBALS['root'] = BigInt64Array::of($GLOBALS['array'], new EvilObject());

$GLOBALS['giant'] = new GiantObject();

$evil_object = new EvilObject();

gc_collect_cycles(); // trigger

?>

