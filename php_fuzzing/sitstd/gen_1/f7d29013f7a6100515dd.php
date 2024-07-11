<?php
function callback($carry, $current) {
    return true;
}

$result = array_reduce(range(0, 0), 'callback', true);

array_diff_assoc(array_map(function($x) { return $x * 3.14159; }, range(0, 10)), array_map(function($x) { return $x * sqrt(2); }, range(0, 10)), array_map(function($x) { return $x * pi(); }, range(0, 10)));

var_dump($result);
?>
