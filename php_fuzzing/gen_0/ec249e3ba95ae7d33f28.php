<?php
for ($i = 0; $i < 5000; $i++) {
    try {
        array_reduce(array(), function() {});
    } catch (Exception $x) {
    }
}
?>
