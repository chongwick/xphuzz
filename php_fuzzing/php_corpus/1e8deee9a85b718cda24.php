<?php

load('wasm-constants.php');
load('wasm-module-builder.php');

verifyHeap();
global $globalCounter;
$globalCounter = 10000000;

function testProperties($obj) {
    for ($i = 0; $i < 3; $i++) {
        $obj->x = 1001;
        assertEquals(1001, $obj->x);

        $obj->y = "old";
        assertEquals("old", $obj->y);

        unset($obj->y);
        assertEquals("undefined", gettype($obj->y));

        $uid = $globalCounter++;
        $fresh = "f_". $uid;

        $obj->z = $fresh;
        assertEquals($fresh, $obj->z);

        $obj->$fresh = $uid;
        assertEquals($uid, $obj->$fresh);

        verifyHeap();

        assertEquals(1001, $obj->x);
        assertEquals($fresh, $obj->z);
        assertEquals($uid, $obj->$fresh);
    }

    // These properties are special for JSFunctions.
    $obj->name = "crazy";
    $obj->length = 999;
}

function minus18($x) {
    return $x - 18;
}

function id($x) {
    return $x;
}

function printName($when, $f) {
    echo "    ". $when. ": name=". $f->name. ", length=". $f->length. "\n";
}

function ExportedFunctionTest() {
    echo "ExportedFunctionTest\n";

    echo "  instance 1, exporting\n";
    $builder = new WasmModuleBuilder();
    $builder->addFunction("exp", "i(i)")
        ->addBody([
            "get_local", 0,
            "call_function", 0])
        ->exportAs("exp");
    $module1 = $builder->toModule();
    $instance1 = new WebAssemblyInstance($module1);
    $g = $instance1->exports->exp;

    testProperties($g);

    // The WASM-internal fields of {g} are only inspected when {g} is
    // used as an import into another instance.
    echo "  instance 2, importing\n";
    $builder
