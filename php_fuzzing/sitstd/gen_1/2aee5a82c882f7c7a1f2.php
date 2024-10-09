<?php
<code>
<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return true;
        }
    }
    return false;
}

function g($v) {
    return get_class($v);
}

function f() {
    $i = 0;
    do {
        $i++;
        g(new stdClass());
    } while ($i < 1);
}

if (!assertThrows('function fun($a = array("a" => 30)) { }', 'ParseError')) {
    echo "Test failed";
}

g(new stdClass());
g(new stdClass());

f();

?>
</code>

?>