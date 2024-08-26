<?php
require "/home/w023dtc/template.inc";


class MyRegExp {
  public $pattern;
  public function __wakeup() {
    $this->pattern = '^.';
  }
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = PHP_INT_MAX. 'AAAAAAA';

unserialize(serialize($myRegExp));

var_dump($myRegExp->pattern);

?>
