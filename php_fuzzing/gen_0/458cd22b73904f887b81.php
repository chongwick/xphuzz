<?php

function t() {
    $re = preg_match('/-/', '2016-01-02');
    return $re;
}

for ($q = 0; $q < 10000; $q++) {
    t();
}

?>
