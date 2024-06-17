<?php

// seal then freeze.
function sealFreeze() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

sealFreeze();

// preventExtensions then freeze.
function preventExtensionsFreeze() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

preventExtensionsFreeze();

// preventExtensions then seal.
function preventExtensionsSeal() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

preventExtensionsSeal();

// freeze.
function freeze() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

freeze();

// seal.
function seal() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

seal();

// preventExtensions.
function preventExtensions() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
}

preventExtensions();

?>
