<?php

function OrigReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return [];
    };
    $f();
  } catch (TypeError $e) {
    echo 'OrigReproCase: '. $e->getMessage(). "\n";
  }
}
OrigReproCase();

filter_var(5473817451, FILTER_VALIDATE_IP, array("a" => 0, "b" => -1, "c" => 2.23431234213480e-400));

function SimpleReproCase() {
  try {
    $f = function($y = []) use (&$x) {
      return [];
    };
    $f();
  } catch (TypeError $e) {
    echo 'SimpleReproCase: '. $e->getMessage(). "\n";
  }
}
SimpleReproCase();

?>
