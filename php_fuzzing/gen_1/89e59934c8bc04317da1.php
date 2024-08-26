<?php
require "/home/w023dtc/template.inc";


class Ctor {
  public function __construct() {
    $this->n = new SplFixedArray(PHP_INT_MAX);
  }
}

class Check {
  public function __construct() {
    $this->n = PHP_INT_MIN;
  }
}

for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
  new Ctor();
}

for ($i = 0; $i < PHP_FLOAT_MIN; $i++) {
  new Check();
}

new Ctor();
new Check();

$vars["SimpleXMLElement"]->addAttribute(str_rot13(strrev(base64_encode(microtime(true)))), str_split('qwertyuiopasdfghjklzxcvbnm', 257)[0], str_replace(['\\', '/', ':', '*', '?', '<', '>', '"', '|', "'"], ['π', '≈', 'Ω', 'Σ', 'φ', '∞', 'τ', '∫', 'ψ', '⋆'], '∑')) + str_repeat(chr(65533), 123);

?>
