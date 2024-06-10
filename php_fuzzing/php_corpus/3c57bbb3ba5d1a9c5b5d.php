<?php

function f() {
    return range(1, 100000); // Replace with your desired data
}

function g() {
    $data = f();
    foreach ($data as $i) {}
}

g();
g();
g();

?>
