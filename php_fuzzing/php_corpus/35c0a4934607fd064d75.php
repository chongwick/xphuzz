<?php

class WasmModuleBuilder {
    public function addType($signature) {
        // implementation
    }

    public function addFunction($name, $sig) {
        $function = new stdClass();
        $function->body = [];
        return $function;
    }

    public function addBodyWithEnd($body) {
        // implementation
    }

    public function instantiate() {
        // implementation
    }
}

$builder = new WasmModuleBuilder();
$builder->addType([kWasmF32, kWasmF32, kWasmI32, kWasmI32, kWasmI32, kWasmExternRef, kWasmI32, kWasmI32, kWasmI32, kWasmI64]);
$function1 = $builder->addFunction('undefined', 0 /* sig */); // define the function name
$function1->body = [];
$function2 = $builder->addFunction('undefined', 0 /* sig */);
$function2->body = array(
    kExprLocalGet, 0x00,  // local.get
    kExprLocalGet, 0x01,  // local.get
    kExprLocalGet, 0x02,  // local.get
    kExprLocalGet, 0x03,  // local.get
    kExprI32Const, 0x05,  // i32.const
    kExprLocalGet, 0x05,  // local.get
    kExprLocalGet, 0x06,  // local.get
    kExprLocalGet, 0x07,  // local.get
    kExprI32Const, 0x5b,  // i32.const
    kExprI32Const, 0x30,  // i32.const
    kExprCallFunction, 0x01,  // call function #1: l_ffiiiniiii
    kExprLocalGet, 0x00,  // local.get
    kExprLocalGet, 0x01,  // local.get
    kExprLocalGet, 0x02,  // local.get
    kExprLocalGet, 0x03,  // local.get
    kExprLocalGet, 0x07
