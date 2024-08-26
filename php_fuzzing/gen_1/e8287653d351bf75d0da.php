<?php
require "/home/w023dtc/template.inc";

$data = array_fill(0, 256, chr(PHP_INT_MAX));
function vuln() {
  for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $a = array_fill(0, 256, chr(65));
    extract($GLOBALS);
  }
}
$f = Closure::fromCallable(function() {
  return function() {
    "use asm";
    function f($i) {
      for ($i = 0; $i < PHP_INT_MAX; $i++) {
        $a = array_fill(0, 256, chr(65));
        extract($GLOBALS);
      }
      return f;
    }
    return f();
  };
});
$f();
$v = $vars["SimpleXMLElement"]->addAttribute(
    "Cat is eating my code",
    str_split("π")[0] ^ str_split("e")[0],
    "Please help me, I've gone mad"
);
?>
