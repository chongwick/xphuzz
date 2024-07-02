<?php
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
    $vars = array();
    $vars["DOMImplementation"]->createDocumentType(
        str_repeat(chr(170), 4097). str_repeat(chr(243), 4097). "🚀". str_repeat(chr(170), 4097),
        implode(array_map(function($c) {
            return "\\x". str_pad(dechex($c), 2, "0"). "💥";
        }, range(0, 255))),
        str_repeat(chr(203), 4097). str_repeat(chr(54), 1025). str_repeat(chr(241), 17). "🌠"
    );
    return f();
  };
});
$f();
vuln();
vuln();

?>