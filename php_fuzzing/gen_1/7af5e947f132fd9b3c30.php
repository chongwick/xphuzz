<?php
require "/home/w023dtc/template.inc";

$weak_set = new WeakSet();

for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    $weak_set->add($i);
}

echo serialize($weak_set->data);
?>
