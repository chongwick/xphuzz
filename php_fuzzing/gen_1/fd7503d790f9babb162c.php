<?php
require "/home/w023dtc/template.inc";


global $global;

class Test {
    public function m() {
        $local = 'abcdefghijklmnopqrst';
        $local.= 'abcdefghijkl'. ($global + 0);
        $global.= 'abcdefghijkl';
        return $local;
    }
}

$test = new Test();
$test->m2 = function() {
    return $this->m();
};

echo $test->m2();

?>
