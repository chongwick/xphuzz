<?php
function callback($carry, $current) {
    return true;
}
$result = array_reduce(range(0, 0), 'callback', true);
var_dump($result);
?>
