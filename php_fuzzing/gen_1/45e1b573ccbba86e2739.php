<?php
require "/home/w023dtc/template.inc";


class MyRegExp {
    function __construct($pattern, $flags = '') {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    function exec($str) {
        $r = preg_match_all($this->pattern. $this->flags, $str, $matches, PHP_INT_MAX);
        if ($r) {
            $matches = array($matches, PHP_INT_MIN);
        }
        return $matches;
    }
}

$crash = new MyRegExp('x','s');
$result = $crash->exec('abc');

echo ($crash->exec('x') * PHP_FLOAT_MAX);

?>
