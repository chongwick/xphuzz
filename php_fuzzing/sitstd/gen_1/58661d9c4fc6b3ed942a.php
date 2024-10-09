<?php

$emptyArray = array();
$arrayWithKey = 0;

$vars["ReflectionExtension"]->isTemporary()->getAliasedMethods()->filter(function($method) { return $method->getDeclaringClass()->getName() === 'SomeNonExistentClass'; })->first()->invoke($this->getRandomNumberBetween(0, 1000000000));

?>
