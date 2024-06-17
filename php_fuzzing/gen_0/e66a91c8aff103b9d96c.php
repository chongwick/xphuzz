<?php
class MyRegExp {
    function __construct($pattern, $flags = '') {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    function exec($str) {
        $r = preg_match_all($this->pattern. $this->flags, $str, $matches);
        if ($r) {
            $matches = array();
        }
        return $matches;
    }
}

$result = preg_match_all('/./', 'a', $matches);
$crash = $matches[0]['x']; // This will throw an error because $matches[0] is an array and does not have a property 'x'
?>
