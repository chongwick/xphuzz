<?php

class WasmModuleBuilder {
    public function addFunction($name, $signature) {
        // Implement this method
    }

    public function addBodyWithEnd($body) {
        // Implement this method
    }

    public function addExport($name, $index) {
        // Implement this method
    }

    public function instantiate() {
        // Implement this method
    }
}

class WasmFunction {
    public function __construct($signature) {
        // Implement this constructor
    }

    public function addBody($body) {
        // Implement this method
    }
}

class WasmExport {
    public function __construct($name, $index) {
        // Implement this constructor
    }
}

$builder = new WasmModuleBuilder();
$function = new WasmFunction('i_v');
$body = array(
   'signature' => 'i_v',
    'body' => array(
        'kExprI32Const' => 0x37,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0xb9,
        'kExprI32Const' => 0xf2,
        'kExprI32Const' => 0xd8,
        'kExprI32Const' => 0x01,
        'kSimdPrefix' => 'i8x16.splat',
        'kSimdPrefix' =>'s128.andnot',
        'kExprI32Const' => 0xb2,
        'kExprI32Const' => 0xf2,
        'kExprI32Const' => 0x00,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0x00,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0xf2,
        'kExprI32Const' => 0x82,
        'kExprI32Const' => 0x02,
    ),
);

$function->addBody($body);

// This test triggers table allocation in large object space. We don't care
// about the result as long as we don't crash.
$array = array();
$array[0x80000] = 1;
$array = array_merge(array(), array(new stdClass()));
try {
    new \WeakMap($array);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
