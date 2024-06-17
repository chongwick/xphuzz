<?php
class MyRegExp {
  function exec($str) {
    $r = preg_match_all($this->pattern, $str, $matches);
    $matches[0] = 0; // Value could be changed to something arbitrary
    return $matches;
  }
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = '.';
$matches = $myRegExp->exec('a');
print_r($matches);

?>