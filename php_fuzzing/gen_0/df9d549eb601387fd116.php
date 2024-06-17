<?php

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

echo f(true). "\n";
echo f(true). "\n";
echo f(false). "\n";

?>
