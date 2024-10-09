<?php

function t() {
    $re = preg_match('/-/', '2016-01-02');
    return $re;
}

function f($i) {
    if ($i == 0) {
        class Derived extends stdClass {
            function __construct() {
                $this->a = 1;
                for ($j = 0; $j < 524286; $j++) {
                    $this->a = 1;
                }
            }
        }
        return new Derived();
    }

    $base = f($i - 1);
    return $base;
}

for ($q = 0; $q < 10000; $q++) {
    $a = f(32767);
    var_dump($a);
    t();
}

?>
