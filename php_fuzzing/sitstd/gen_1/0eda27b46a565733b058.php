<?php

class MyRegExp {
  public function exec($str) {
    $r = preg_match_all($this->pattern, $str, $matches);
    if ($r) $matches = array();
    return $matches;
  }
}

class C {
}

function f($b) {
    $o = new C();
    if ($b) {
        $o->t = 1.1;
    }
    return $o->t;
}

for ($i = 0; $i < 1000; $i++) {
    new C();
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = '^.';

$result = $myRegExp->exec('a');

echo f(true). "\n";
echo f(true). "\n";
echo f(false). "\n";

var_dump($result[0]->x);

?>
