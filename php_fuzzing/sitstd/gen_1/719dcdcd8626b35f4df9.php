<?php

class AsyncHook {
    private $enabled = false;

    public function enable() {
        $this->enabled = true;
    }

    public function promiseReject($resource) {
        if ($this->enabled) {
            throw new Exception();
        }
    }
}

$asyncHook = new AsyncHook();
$asyncHook->enable();

function opt($ar, $i) {
  return $ar[$i]. (is_nan($ar[$i])? '' : '');
}

function foo() {
    yield from [1];
}

$generator = foo();
foreach ($generator as $x) {
    // do nothing
}

ShortcutEmptyStringAddRight() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutiEmptyStringAddLeft() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

function ShortcutEmptyStringAddRight() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutEmptyStringAddLeft() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

?>
