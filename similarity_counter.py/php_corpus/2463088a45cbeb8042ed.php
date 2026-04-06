<?php

class MyRegExp {
  public function exec($str) {
    $r = preg_match_all($this->pattern, $str, $matches);
    if ($r) $matches = array();
    return $matches;
  }
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = '^.';

$result = $myRegExp->exec('a');

var_dump($result[0]->x);

?>
