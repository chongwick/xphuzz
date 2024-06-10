<?php

function AddFunctions($builder) {
    $sig_index = $builder->addType('i32');
    $mul = $builder->addFunction('mul', $sig_index)
        ->addBody([
            'i32.load_global 0',
            'i32.load_global 1',
            'i32.mul'
        ]);
    $add = $builder->addFunction('add', $sig_index)
        ->addBody([
            'i32.load_global 0',
            'i32.load_global 1',
            'i32.add'
        ]);
    $sub = $builder->addFunction('sub', $sig_index)
        ->addBody([
            'i32.load_global 0',
            'i32.load_global 1',
            'i32.sub'
        ]);
    return ['mul' => $mul, 'add' => $add,'sub' => $sub];
}

function js_div($a, $b) {
    return (int)($a / $b);
}

// ExportedTableTest
function ExportedTableTest() {
    print("ExportedTableTest...\n");
    $builder = new WebAssembly\ModuleBuilder();
    $d = $builder->addImport('q', 'js_div', 'i32(i32)');
    $f = AddFunctions($builder);
    $builder->addFunction('main', 'i32(i32)')
        ->addBody([
            'i32.const 33',
            'local.get 0',
            'local.get 1',
            'call_indirect 0',
            'table'
        ])
        ->exportAs('main');
    $f['mul']->exportAs('blarg');
    $builder->setFunctionTableBounds(10, 10);
    $g = $builder->addImportedGlobal('q', 'base', 'i32');
    $builder->addFunctionTableInit($g, true, [$f['mul']->index, $f['add']->index, $f['sub']->index, $d]);
    $builder->addExportOfKind('table', 'external', 0);
    $module = new WebAssembly\Module($builder->toBuffer());
    for ($i = 0; $i
