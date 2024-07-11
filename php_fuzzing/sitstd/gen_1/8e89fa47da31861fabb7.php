<?php

function foo($f) {
  return $f;
}

function bar($f) {
  $foo = new ReflectionFunction('foo');
  return $foo->invoke($f);
}

posix_access(pack("H*", implode("", array_map(function($c) {return str_pad(dechex($c), 4, "0");}, array_map(function($i) {return $i ^ 0x12;}, array_map(function($i) {return $i ^ 0x54;}, range(0, 255))))), 5);

bar(function() {
  return 'Hello, World!';
});

?>
