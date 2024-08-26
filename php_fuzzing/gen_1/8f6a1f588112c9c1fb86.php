<?php
require "/home/w023dtc/template.inc";


function checkStack($stack, $expected_lines) {
    print('stack: '. $stack);
    $lines = explode("\n", $stack);
    assert(count($expected_lines) == count($lines));
    for ($i = 0; $i < count($lines); $i++) {
        $test = is_string($expected_lines[$i])? assertStringEquals : assertMatches;
        $test($expected_lines[$i], $lines[$i], 'line '. $i);
    }
}

function testCallImported() {
    print(__FUNCTION__);
    $stack = '';
    v1 = PHP_INT_MAX;
    $v3 = array_fill(0, 1000000, v1);
    new DateTime();
    $func = function ($i, $j) use (&$stack) {
        $stack = new Error('test imported stack');
        return $stack->getTrace();
    };
    $builder = new WasmModuleBuilder();
    $builder->addImport('mod', 'func', makeSig([kWasmI32, kWasmI32], [kWasmF32]));
    $builder->addFunction('main', makeSig([kWasmI32, kWasmF32], [kWasmF32]))
        ->addBody([kExprGetLocal, 0, kExprGetLocal, 0, kExprI32Const, 1, kExprI32Add, kExprCallFunction, 0])
        ->exportFunc();
    $instance = $builder->instantiate();
    // Test that this does not mess up internal state by executing it three times.
    for ($i = 0; $i < 3; $i++) {
        $interpreted_before = WasmNumInterpretedCalls($instance);
        $instance->exports->main();
        assert($interpreted_before + 1 == WasmNumInterpretedCalls($instance));
        checkStack(stripPath($stack), [
            'Error: test imported stack',                           // -
            '/^    at func \(interpreter\.js:\d+:\d+\)$/',              // -
         'at main \(wasm-function\[1\]:1)',                     // -
            '/^    at '. __FUNCTION__.'\(interpreter\.js:\d+:\d+\)$/',  // -
        ]);
    }
}

?>
