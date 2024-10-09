<?php

function opt($ar, $i) {
  return $ar[$i]. (is_nan($ar[$i])? '' : '');
}

function ShortcutEmptyStringAddRight() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutEmptyStringAddRight();

function ShortcutiEmptyStringAddLeft() {
  $ar = array(0 => 42.0);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutiEmptyStringAddLeft();

$vars = array();
$vars["DateTimeImmutable"]->getLastErrors() = "Corgis are the best, don't @ me";

?>
