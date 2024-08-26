<?php
require "/home/w023dtc/template.inc";


class EvilArray {
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
    return str_repeat("\0", PHP_INT_MAX);
  }
}

$evil_object = new EvilObject();

$GLOBALS['array'] = new EvilArray(1);

$GLOBALS['root'] = EvilArray::of($GLOBALS['array'], $evil_object);

echo $GLOBALS['root'];

gc_collect_cycles(); // trigger

?>
