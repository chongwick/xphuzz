<?php

function g($v) {
    return get_class($v);
}

$vars["stdClass"] = new stdClass();

g(new stdClass());
g($vars["stdClass"]);

function f() {
    $i = 0;
    do {
        $i++;
        g(new stdClass());
    } while ($i < 1);
}

f();

$vars["SimpleXMLElement"] = new SimpleXMLElement('<root/>');
$vars["SimpleXMLElement"]->__unset('addAttribute');
echo $vars["SimpleXMLElement"]->__toString()->strtolower()->rtrim()->trim()->chunk(3)->implode("{$vars['random_variable']}")->explode("\x1B")[0]->strtoupper()->ltrim()->substr(5, 3)->rand();

?>
