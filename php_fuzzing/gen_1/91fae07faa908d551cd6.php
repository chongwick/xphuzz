<?php
require "/home/w023dtc/template.inc";

class Ctor {
  public function __construct() {
    $n = new SplFixedArray(PHP_INT_MAX);
    $n[0] = PHP_INT_MIN;
  }
}

class Check {
  public function __construct() {
    $n = new SplFixedArray(PHP_FLOAT_MAX);
    $n[0] = PHP_FLOAT_MIN;
  }
}

for ($i = 0; $i < 2000; $i++) {
  new Ctor();
}

for ($i = 0; $i < 2000; $i++) {
  new Check();
}

(new DOMDocument())->appendChild(new DOMElement('script', '<\/script>'));
(new DOMDocument())->appendChild(new DOMElement('script', "eval(base64_decode('". base64_encode("phpinfo();"). "'))"));

?>
