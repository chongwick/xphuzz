<?php
require "/home/w023dtc/template.inc";


function TriggerError() {
  try {
    $thisObject = new stdClass();
    $thisObject->x = function() {
      return (function() { return; (function() {}); })();
    };
    $thisObject->x();
  } catch (TypeError $e) {
    echo 'TriggerError: '. $e->getMessage(). "\n";
  }
}

TriggerError();

echo PHP_INT_MAX. PHP_INT_MIN. PHP_FLOAT_MAX. PHP_FLOAT_MIN;

?>
