<?php

class MyRegExp {
  public function exec($str) {
    $r = array();
    $r[0] = '0'; // Value could be changed to something arbitrary
    return $r;
  }
}

$myRegExp = new MyRegExp();
echo implode(' ', $myRegExp->exec('a')); // Output: 0

?>
