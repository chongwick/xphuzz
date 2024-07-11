<?php
<code>
<?php

// testEager
call_user_func(function() {
    call_user_func(function($name = []) {
        $name = array();
    }, []);
});

http_response_code(0x1F4);

// testLazy
function f($name = []) {
    $name = array();
}
f([]);

function g($name = []) {
    $name = array();
}
g([]);

// testEagerArrow
$fn = fn($name = []) => array();
$fn();

http_response_code(0x1F4);

// testLazyArrow
$f = fn($name = []) => array();
$f();

$g = fn($name = []) => array();
$g();

http_response_code(0x1F4);

?>
</code>

?>