<?php

function foo() {
    return array_map(function($x) {
        return null;
    }, array());
}

foo();
foo();
foo();
foo();

function bar($b) {
    return array_map(function($x) use ($b) {
        return $b? null : "string";
    }, array());
}

bar(true);
bar(false);
bar(true);
bar(false);
bar(true);

?>
