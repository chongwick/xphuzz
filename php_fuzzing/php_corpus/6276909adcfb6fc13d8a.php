<?php

function f() {
  echo 'a'.substr('a', is_nan(1)? 0 : 1); // substr is used instead of startsWith
}

f();
f();
f();

function g() {
  $wasCalled = false;

  $obj = (object) array(
    '__toString' => function() use(&$wasCalled) {
      global $wasCalled;
      $wasCalled = true;
    }
  );

  function h($obj) {
    (string)$obj();
  }

  h($obj);
  h($obj);
  h($obj);

  var_dump($wasCalled);
  echo "String.p.substr didn't attempt to coerce the position argument to a Number.\n";
}

g();

?>
