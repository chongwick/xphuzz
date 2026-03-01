<?php
$iter1 = new ArrayIterator(array(1,2,3));
$iter2 = new ArrayIterator(array(1,2));
$iter3 = new ArrayIterator(array(new stdClass(),"string",3));
$m = new MultipleIterator();
$m->setFlags(MultipleIterator::MIT_NEED_ALL | MultipleIterator::MIT_KEYS_ASSOC);
$m->attachIterator($iter1, "1");
$m->attachIterator($iter2, "2");
$m->attachIterator($m, 3);
foreach($m as $key => $value) {
    var_dump($key, $value);
}
?>
