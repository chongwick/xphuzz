<?php
require "/home/w023dtc/template.inc";


class Symbol {
    public function symbol() {
        echo "Symbol called\n";
    }
}

class WasmModuleBuilder {
    private $functions = [];
    private $tables = [];

    public function addImportedTable($name, $table, $initial, $maximum, $type) {
        $this->tables[$name] = ['initial' => $initial,'maximum' => $maximum, 'type' => $type];
    }

    public function addFunction($name, $signature) {
        $this->functions[$name] = $signature;
        return $this;
    }

    public function exportFunc($name) {
        if (isset($this->functions[$name])) {
            $table = $this->tables[$name];
            echo "Exporting function '$name' with table '$name'\n";
            echo "  Initial: $table[initial]\n";
            echo "  Maximum: $table[maximum]\n";
            echo "  Type: $table[type]\n";
        } else {
            throw new Exception("Function '$name' does not exist");
        }
    }

    public function toModule() {
        // Implement the method
    }
}

$builder = new WasmModuleBuilder();
$builder->addImportedTable('ffi', 't1', PHP_INT_MAX, PHP_INT_MAX, 'anyfunc');
$builder->addImportedTable('ffi', 't2', PHP_INT_MIN, PHP_INT_MIN, 'anyfunc');

$builder->addFunction('foo', 'v_v')->exportFunc('foo');

$module = $builder->toModule();
$table1 = ['initial' => PHP_FLOAT_MAX,'maximum' => PHP_FLOAT_MAX, 'type' => 'anyfunc'];
$table2 = ['initial' => PHP_FLOAT_MIN,'maximum' => PHP_FLOAT_MIN, 'type' => 'anyfunc'];

$instance = new stdClass();
$instance->exports = new stdClass();
$instance->exports->foo = $table2;
WebAssembly::Instance($module, ['ffi' => ['t1' => $table1, 't2' => $table2]])->symbol();

?>
