<?php
function& foo() {
    static $a = null;
    if (!isset($a)) {
        $a = new stdClass();
        $a->foo = array();
        foreach (array_fill(0, 1000000, true) as $b) {
            $a->foo[] = $b;
        }
    }
    return $a;
}

foo()[0];

?>