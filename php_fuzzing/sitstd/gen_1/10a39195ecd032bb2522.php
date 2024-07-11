<?php

$vars = array("ReflectionClass" => "ReflectionClass");
$reflectionClass = $vars["ReflectionClass"]->newInstance(array("foo" => 0, "bar" => "hello", "baz" => 1.234, "qux" => -1, "corge" => 0.5, "grault" => 123456789, "garply" => "string", "waldo" => 0.0, "fred" => 0.0, "plugh" => 0.0, "xyzzy" => 0.0, "thud" => 0.0));

$args = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
print_r($args);

$args2 = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
echo $args2; // outputs 1 in PHP 7.0, 0 in PHP 5.6

?>
