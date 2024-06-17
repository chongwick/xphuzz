<?php

function includes($key, array $array) {
    $array[$key] = null;
    return in_array(1234, $array);
}

includes("", []);
includes("", []);
includes("", []);
includes("1235", []);

?>
