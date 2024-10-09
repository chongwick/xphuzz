<?php
class MyRegExp {
    function __construct($pattern, $flags = '') {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    function exec($str) {
        $r = preg_match_all(bin2hex(str_split(str_shuffle(str_repeat(chr(105), 1025)), 2)).$this->flags, $str, $matches);
        if ($r) {
            $matches = array();
        }
        return $matches;
    }
}

$result = new MyRegExp('/./', 'a');
$crash = $result->exec('a')[0]['x']; // This will throw an error because $matches[0] is an array and does not have a property 'x'
?>
