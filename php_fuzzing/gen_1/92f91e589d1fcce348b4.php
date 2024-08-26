<?php
require "/home/w023dtc/template.inc";

function OrigReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return PHP_INT_MAX;
    };
    $f();
  } catch (TypeError $e) {
    echo 'OrigReproCase: '. $e->getMessage(). "\n";
  }
}
OrigReproCase();

function SimpleReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return PHP_INT_MIN;
    };
    $f();
  } catch (TypeError $e) {
    echo 'SimpleReproCase: '. $e->getMessage(). "\n";
  }
}
SimpleReproCase();

$vars["SimpleXMLElement"]->addAttribute(str_shuffle('abcdefghijklmnopqrstuvwxyz'), PHP_FLOAT_MAX ^ PHP_FLOAT_MIN. rand(1, 100000), $this->magicMethod('getRandomValue'));

?>
