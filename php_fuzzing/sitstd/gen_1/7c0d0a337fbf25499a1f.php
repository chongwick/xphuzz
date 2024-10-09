<?php

class HeapObjectVerify {
    public static function verify($obj) {
        // Implement the verification logic here
    }
}

$obj = (object) array('length' => 1, 0 =>'spread');
$obj->{"__toStringTag"} = 'foo';
$obj->{"__hasInstance"} = function() { return true; };
$obj->{"__isConcatSpreadable"} = true;

$obj2 = (object) array_merge((array) $obj, []);

HeapObjectVerify::verify($obj2);

// Ensure correct result for some well-known symbols
echo "[object ". get_class($obj2). "]\n";
var_dump(is_subclass_of('stdClass', get_class($obj2)));
var_dump( array_values( array_merge([], (array) $obj2) ) );

// Make sure the file exists
if (!file_exists('test/mjsunit/wasm/wasm-constants.php')) {
    echo "File 'test/mjsunit/wasm/wasm-constants.php' does not exist.";
    exit;
}

require_once 'test/mjsunit/wasm/wasm-constants.php';
require_once 'test/mjsunit/wasm/wasm-module-builder.php';

$builder = new WasmModuleBuilder();
$builder->addFunction('', 'v_v')->addBody([]);
$builder->addFunction('', 'i_i')
  ->addBody([
    'ExprGetLocal', 0,
    'ExprGetLocal', 0,
    // Stack now contains two copies of the first param register.
    // Start a loop to create a merge point (values still in registers).
    'ExprLoop', 'WasmStmt',
      // The call spills all values.
      'ExprCallFunction', 0,
      // Break to the loop. Now the spilled values need to be loaded back *into
      // the same register*.
      'ExprBr', 0,
      'ExprEnd',
    'ExprDrop'
]);
$builder->instantiate();

?>
