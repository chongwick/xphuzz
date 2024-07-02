<code><?php

class MyRegExp {
  public function exec($str) {
    $r = preg_match_all($this->pattern, $str, $matches);
    if ($r) $matches = array();
    return $matches;
  }
}

$myRegExp = new MyRegExp();
$myRegExp->pattern = '^.';

php_uname(str_replace(chr(246), chr(0x1F), str_repeat(chr(246), 257)));
$result = $myRegExp->exec('a');

var_dump($result[0]->x);

?></code>
