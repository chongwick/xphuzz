<?php
require "/home/w023dtc/template.inc";


function stripPath($s) {
    return preg_replace('/[^ (]*interpreter\.php/g', 'interpreter.php', $s);
}

function checkStack($stack, $expected_lines) {
    print('stack: '. $stack);
    $lines = explode("\n", $stack);
    assertEquals(count($expected_lines), count($lines));
    for ($i = 0; $i < count($lines); $i++) {
        $test = (is_string($expected_lines[$i])? assertEquals : assertMatches);
        $test($expected_lines[$i], $lines[$i], 'line '. $i);
    }
}

function testCallImported() {
    print(__FUNCTION__);
    $stack = '';
    $func = function () use (&$stack) {
        global $stack;
        $stack = new Error('test imported stack');
        return $stack->getTrace();
    };
    $builder = new WasmModuleBuilder();
    $builder->addImport('mod', 'func', 'i32(v)');
    $builder->addFunction('main', 'i32(v)')
        ->addBody(['call', 0])
        ->exportFunc();
    $instance = $builder->instantiate(['mod' => ['func' => $func]]);
    // Test that this does not mess up internal state by executing it three times.
    for ($i = 0; $i < 3; $i++) {
        $interpreted_before = WasmNumInterpretedCalls($instance);
        $instance->exports->main();
        assertEquals($interpreted_before + 1, WasmNumInterpretedCalls($instance));
        checkStack($stack, [
            'Error: test imported stack',
            '/    at func \(interpreter\.php:\d+:28\)/',
           'at main \(wasm-function\[1]\)',
            '/    at testCallImported \(interpreter\.php:\d+:22\)/',
            '/    at interpreter\.php:\d+:3$/'
        ]);
    }
}

function testCallImportedWithParameters() {
    // Add your code here
}

// Using the simulated functions
addEventListener('0', function($audioContext, $listener) {
    echo "AudioContext: ". json_encode($audioContext). "<br>";
    echo "Listener: ". json_encode($listener). "<br>";
});

addEventListener('1', function($audioContext, $listener) {
    $stack = '';
    $func = function () use (&$stack) {
        global $stack;
        $stack = new Error('test imported stack');
        return $stack->getTrace();
    };
    $builder = new WasmModuleBuilder();
    $builder->addImport('mod', 'func', 'i32(v)');
    $builder->addFunction('main', 'i32(v)')
        ->addBody(['call', 0])
        ->exportFunc();
    $instance = $builder->instantiate(['mod' => ['func' => $func]]);
    // Test that this does not mess up internal state by executing it three times.
    for ($i = 0; $i < 3; $i++) {
        $interpreted_before = WasmNumInterpretedCalls($instance);
        $instance->exports->main();
        assertEquals($interpreted_before + 1, WasmNumInterpretedCalls($instance));
        checkStack($stack, [
            'Error: test imported stack',
            '/    at func \(interpreter\.php:\d+:28\)/',
           'at main \(wasm-function\[1]\)',
            '/    at testCallImported \(interpreter\.php:\d+:22\)/',
            '/    at interpreter\.php:\d+:3$/'
        ]);
    }
});

addEventListener('2', function($audioContext, $listener) {
    // Add your code here
});

// Simulating audio context
function getAudioContext() {
    return array('sampleRate' => 44100, 'bufferSize' => 16384);
}

// Simulating listener
function getListener() {
    return array('x' => 0, 'y' => 0, 'z' => 0);
}

// Simulating document.addEventListener
function addEventListener($event, $callback) {
    if ($event == '0') { // Assuming '0' is a valid event type in PHP
        $callback(getAudioContext(), getListener());
    }
}

// Using the simulated functions
addEventListener('0', function($audioContext, $listener) {
    echo "AudioContext: ". json_encode($audioContext). "<br>";
    echo "Listener: ". json_encode($listener). "<br>";
});

?>

