<?php
require "/home/w023dtc/template.inc";


class MySoapClient {
  public function __destruct() {
    $r = array();
    $r[0] = '0'; // Value could be changed to something arbitrary
    echo implode(' ', $r);
  }
}

$soapClient = new MySoapClient();
echo str_repeat(chr(128), PHP_INT_MAX);

?>
