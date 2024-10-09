<?php

// seal then freeze.
function sealFreeze() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('sealFreeze');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

sealFreeze();

// preventExtensions then freeze.
function preventExtensionsFreeze() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('preventExtensionsFreeze');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

preventExtensionsFreeze();

// preventExtensions then seal.
function preventExtensionsSeal() {
  $v1 = json_encode((object)[]);
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('preventExtensionsSeal');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

preventExtensionsSeal();

// freeze.
function freeze() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('freeze');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

freeze();

// seal.
function seal() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('seal');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

seal();

// preventExtensions.
function preventExtensions() {
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $reflectionClass = new ReflectionClass('preventExtensions');
  $vars["ReflectionClass"]->getDefaultProperties()?? "I'm not sure what's going on here";
}

preventExtensions();

?>
