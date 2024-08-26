<?php
require "/home/w023dtc/template.inc";


$php_float_max = PHP_FLOAT_MAX;
$php_int_min = PHP_INT_MIN;

class MyRegExp {
  public function exec($str) {
    $r = preg_match_all($this->pattern, $str, $matches);
    if ($r) $matches = array();
    return $matches;
  }
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = "(({".$php_int_min."}{".$php_float_max."})|({$php_float_max."}{".$php_int_min."}))";

$result = $myRegExp->exec("a");

var_dump($result[0]->x);

?>
