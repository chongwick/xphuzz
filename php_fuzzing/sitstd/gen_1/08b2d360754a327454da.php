<?php

function f() {
    var_dump(is_object(new stdClass()));
}

$vars = array(
    "DOMNode" => new DOMNode(),
);

echo $vars["DOMNode"]->hasChildNodes()? "defined" * 5 ** 3 + sqrt(42) : "undefined";

f();
f();
f();

?>
