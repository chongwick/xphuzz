<?php
require "/home/w023dtc/template.inc";


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

class __Get {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'b') {
            $this->b = array();
            $this->b[] = PHP_INT_MAX;
        }
        return $this->b;
    }
}

$builder = new WasmModuleBuilder();
$function = new WasmFunction('i_v');
$body = array(
'signature' => 'i_v',
    'body' => array(
        'kExprI32Const' => PHP_INT_MAX,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0x37,
        'kExprI32Const' => PHP_INT_MIN,
        'kSimdPrefix' => 'i8x16.splat',
        'kSimdPrefix' =>'s128.andnot',
        'kExprI32Const' => 0xb2,
        'kExprI32Const' => PHP_FLOAT_MAX,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0x00,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => PHP_FLOAT_MIN,
        'kSimdPrefix' => 'i8x16.splat',
        'kExprI32Const' => 0xf2,
        'kExprI32Const' => 0x82,
        'kExprI32Const' => 0x02,
    ),
);

$function->addBody($body);

$a = array(1);
$b = new stdClass();
$b = new __Get($b);
$c = array_merge($a, $b->__get('b'));

?>
