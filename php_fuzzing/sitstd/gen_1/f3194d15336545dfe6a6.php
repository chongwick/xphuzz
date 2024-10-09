<?php
<code>
<?php

class WasmModuleBuilder {
  // Define the methods and properties of the WasmModuleBuilder class

  $cnt = 0;
  $reg = '/./';
  $reg_callback = function () use (&$cnt) {
    global $cnt;
    if ($cnt++ == 0) {
      return array_fill(0, 2 ** 16, null);
    }
    $cnt = 0;
    return null;
  };

  function assertThrows($fn, $expectedException) {
    try {
      $fn();
    } catch (Exception $e) {
      if ($e instanceof $expectedException) {
        // Expected exception, so just continue
      } else {
        throw $e;
      }
    }
  }

  function testRegex() {
    assertThrows(function () {
      preg_replace($reg, $reg_callback, '');
    }, RangeError::class);
  }

}

?>
</code>

?>