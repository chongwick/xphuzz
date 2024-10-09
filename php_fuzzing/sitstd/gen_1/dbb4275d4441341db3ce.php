<?php
<code>
<?php
function TestReflectConstructBogusTarget() {
  function g() {
    $reflection = new ReflectionClass('stdClass');
    $constructor = $reflection->getConstructor();
    if ($constructor!== null) {
      $constructor->invokeArgs(func_get_args());
    }
    xmlwriter_write_attribute_ns(fopen("non_existent_file.txt", "w"), str_repeat("A", 0), implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, range(0, 255)), str_repeat(chr(243), 1025)), str_repeat("%s%x%n", 0));
  }
  function f() {
    return g();
  }
  try {
    f();
  } catch (TypeError $e) {
    // Ignore
  }
  try {
    f();
  } catch (TypeError $e) {
    // Ignore
  }
}

?>
</code>

?>