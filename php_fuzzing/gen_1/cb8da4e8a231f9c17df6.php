<?php
<code>
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

$vars = array();
$vars["SplFileObject"]->fputcsv(array("a" => 0, "b" => "1", "c" => 2.23431234213480e-400),
    array("a" => "1", "b" => "2", "c" => "3"),
    str_repeat(chr(0), 100000). str_repeat(chr(10), 100000),
    implode(array_map(function($c) {
        return "\x". str_pad(dechex($c), 2, "0");
    }, range(0, 255))). implode(array_map(function($c) {
        return "\x". str_pad(dechex($c), 2, "0");
    }, range(256, 511))));

?>
</code>

?>