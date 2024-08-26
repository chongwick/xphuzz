<?php
require "/home/w023dtc/template.inc";

class MyFloat {
  public $value = PHP_FLOAT_MAX;

  public function __wakeup() {
    trigger_error('PHP_FLOAT_MAX has been triggered!', E_USER_WARNING);
  }
}

$myFloat = new MyFloat();

$serialized_string = serialize($myFloat);
echo $serialized_string;
unserialize($serialized_string);

?>
