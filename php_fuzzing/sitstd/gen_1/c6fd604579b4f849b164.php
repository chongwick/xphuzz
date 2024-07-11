<?php
assert_options(ASSERT_ACTIVE);

$data = array_fill(0, 256, chr(65));
function vuln() {
  for ($i = 0; $i < 65536; $i++) {
    $a = array_fill(0, 256, chr(65));
    extract($GLOBALS);
  }
}
$f = Closure::fromCallable(function() {
  return function() {
    "use asm";
    function f($i) {
      for ($i = 0; $i < 65536; $i++) {
        $a = array_fill(0, 256, chr(65));
        extract($GLOBALS);
      }
      return f;
    }
    return f();
  };
});
$f();
vuln();
vuln();
assert_options(ASSERT_DISABLED);

?>