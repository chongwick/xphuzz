<?php
$b = new SplObjectStorage();
for ($i = 10000; $i > 0; $i--) {
    $object = new StdClass();
    $object->a = str_repeat("a", 2);
    $b->attach($object);
}
?>
