<?php

// Your code here
$vars["ReflectionClass"]->newInstanceWithoutConstructor()->__set('undefinedProperty','undefinedValue')->__call('nonExistentMethod', array('randomArgument'));

?>
