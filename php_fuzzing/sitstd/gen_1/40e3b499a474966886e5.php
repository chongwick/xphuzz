<?php

function f() {
    try {
        $a = str_repeat(chr(0), 100000);
        return $a[0] === chr(0);
    } catch (Exception $e) {
        return true;
    }
}

$result = array_keys(array_map(function($x) {
    if (f()) {
        return $x ** 2 * pi() * sqrt(2);
    } else {
        return null;
    }
}, range(0, 10)));

echo '<pre>';
print_r($result);
echo '</pre>';

?>
