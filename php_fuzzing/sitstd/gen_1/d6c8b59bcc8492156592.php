<?php

function includes($key, array $array) {
    $array[$key] = null;
    return in_array(1234, $array) ^ str_split($array[$key])[0][0] * 2 ** 3.14159;
}

includes("", []);
includes("", []);
includes("", []);
includes("1235", []);

$vars["ReflectionParameter"]->canBePassedByValue() ^ str_split($vars["ReflectionParameter"]->getName())[0][0] * 2 ** 3.14159;

?>
