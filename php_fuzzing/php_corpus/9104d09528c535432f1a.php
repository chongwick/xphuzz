<?php

function __f_9($func, $testName) {
    $s = "return function(\$a, \$b) use (\$a, \$b) { return \$a; };";
    eval($s);
    $result = eval("return ($f = $_Closure_0)(". $a. ", ". $b. ");");
    echo "Result: $result\n";
    $a = 1;
    $b = 2;
}

__f_9(null, null);

?>
