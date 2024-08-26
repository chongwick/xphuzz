<?php
require "/home/w023dtc/template.inc";


$vars["SimpleXMLElement"]->addAttribute(pow(PHP_INT_MAX, PHP_INT_MIN), str_repeat(chr(13), 257), str_repeat(chr(0), 123475932));
$wasm = new WasmModuleBuilder();
$wasm->addMemory(2);
$wasm->addFunction("sub", 'i(ii)');
for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
    $wasm->instantiate();
}
echo unserializer('O:8:"stdClass":00000000');

?>
