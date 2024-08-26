<?php
require "/home/w023dtc/template.inc";

class PHPFloatMax {
    public static $value = PHP_FLOAT_MAX;
}

class PHPFloatMin {
    public static $value = PHP_FLOAT_MIN;
}

function AddFunctions($builder) {
    $sig_index = $builder->addType('f(f)');
    $mul = $builder->addFunction('mul', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            PHPFloatMax::$value
        ]);
    $add = $builder->addFunction('add', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            PHPFloatMin::$value
        ]);
    $sub = $builder->addFunction('sub', $sig_index)
        ->addBody([
            'get_local', 0,
            'get_local', 1,
            PHPFloatMax::$value
        ]);
    return ['mul' => $mul, 'add' => $add,'sub' => $sub];
}

echo AddFunctions(new WasmModuleBuilder());
?>
