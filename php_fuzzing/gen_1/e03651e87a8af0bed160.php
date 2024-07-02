<?php

class WasmModuleBuilder {
    public function addImportedTable($name, $table) {
        // implement me
    }

    public function addExportOfKind($kind, $table) {
        // implement me
    }

    public function addFunctionTableInit($global, $init, $functions) {
        // implement me
    }

    public function toBuffer() {
        // implement me
    }
}

class WebAssembly {
    public static function Module($buffer) {
        // implement me
    }

    public static function Instance($module, $exports) {
        // implement me
    }
}

function AddFunctions($builder) {
    $sig_index = $builder->addType('i(i)');
    $mul = $builder->addFunction('mul', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            'i32_mul'
        ]);
    $add = $builder->addFunction('add', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            'i32_add'
        ]);
    $sub = $builder->addFunction('sub', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            'i32_sub'
        ]);
    return ['mul' => $mul, 'add' => $add,'sub' => $sub];
}

function js_div($a, $b) {
    return (int) ($a / $b);
}

$vars["MultipleIterator"]->current()->explode(chr(0x1F), 2)->reverse()->shuffle()->join(chr(0x20));

?>
