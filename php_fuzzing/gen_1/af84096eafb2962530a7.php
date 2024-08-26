<?php
require "/home/w023dtc/template.inc";

class MyDateTimeZone extends DateTimeZone
{
    function __construct()
    {
    }
}

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

class MyArray {
    public $x;
    public $y;
    public function __construct() {
        $this->x = new MyDateTimeZone();
        $this->y = new MyRegExp('/./', '');
    }
}

$fusion = new MyArray();
echo $fusion->y->exec('a');
echo $fusion->x->format(DateTime::ISO8601); // This will crash the PHP interpreter
?>
