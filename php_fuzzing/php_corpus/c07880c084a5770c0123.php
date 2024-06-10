<?php
function f() {
    $var13 = new \ArrayObject();
    $var13[0] = array();
    $var5 = function() use (&$var13) {
        $var9 = array();
        while (true) {
            //print("in loop");
            if (true || true) { // replace abc1 and abc2 with true
                while ($var9) {
                    sleep(1);
                    echo "abc3\n"; // replace abc3 with "abc3"
                }
            }
        }
    };
    $var5();
}

f();
for ($i = 0; $i < 22; $i++) {
    f();
}

?>
