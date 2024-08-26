<?php
require "/home/w023dtc/template.inc";


function crash($buffer) {
    $builder = new WasmModuleBuilder();
    $functions = AddFunctions($builder);
    $module = WebAssembly::Module($builder->toBuffer());
    $exports = array_merge(['foo' =>'mul'], $functions);
    $instance = WebAssembly::Instance($module, $exports);
    $obj = array(
        'foo' => $instance->getExport('foo'),
        'PHP_INT_MAX' => PHP_INT_MAX,
        'PHP_INT_MIN' => PHP_INT_MIN,
        'PHP_FLOAT_MAX' => PHP_FLOAT_MAX,
        'PHP_FLOAT_MIN' => PHP_FLOAT_MIN
    );
    js_div($obj['foo']($obj['foo'](2, 3)), 4); // this will trigger an assertion error
    foo($obj);
    assert($obj['a'] === 10);

}

crash('');

?>
