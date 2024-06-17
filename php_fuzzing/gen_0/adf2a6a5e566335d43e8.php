<?php

function foo() {
    global $global;
    $global = "";
    $global.= "bar";
    return $global;
}

echo foo() === "bar"; // true
echo foo() === "bar"; // true

?>
