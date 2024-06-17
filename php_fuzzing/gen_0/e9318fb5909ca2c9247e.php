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
