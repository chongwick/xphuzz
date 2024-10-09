<?php

function foo() {
    for ($a = 0; $a < 2; $a++) {
        if ($a === 1) {
            // There is no direct equivalent of %OptimizeOsr() in PHP
        }
        while (0 && 1) {
            for ($j = 1; $j < 2; $j++) {
                // This loop does nothing and can be removed
            }
        }
    }
}

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

foo();
$builder = new WasmModuleBuilder();
$functions = AddFunctions($builder);
//... other functions...

?>

