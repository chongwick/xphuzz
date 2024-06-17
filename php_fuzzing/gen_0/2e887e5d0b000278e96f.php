<?php

$o = array_merge(array('length' => 1), array('length' => 2));

$o['x'] = 1;
unset($o['x']);

$o['length'] = 2;

print_r($o);

?>
