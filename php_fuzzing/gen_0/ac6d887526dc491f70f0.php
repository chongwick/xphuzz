<?php

function foo($f) {
  return $f;
}

function bar($f) {
  $foo = new ReflectionFunction('foo');
  return $foo->invoke($f);
}

bar(function() {
  return 'Hello, World!';
});

?>
