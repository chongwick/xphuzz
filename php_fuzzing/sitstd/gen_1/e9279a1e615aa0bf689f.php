<?php

class MyRegExp {
  public function exec($str) {
    $r = array();
    $r[0] = strcoll(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0")."\x1e\x9f";}, range(0, 255))), "abc". str_repeat("%s%x%n", 0x100));
    return $r;
  }
}

$myRegExp = new MyRegExp();
echo implode(' ', $myRegExp->exec('a')); // Output: (the output will be a boolean value)

?>
