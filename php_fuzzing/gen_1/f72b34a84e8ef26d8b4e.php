<?php
require "/home/w023dtc/template.inc";

class MaliciousWasmModuleBuilder extends WasmModuleBuilder {
    private $phpIntMax = PHP_INT_MAX;
    private $phpFloatMax = PHP_FLOAT_MAX;
    private $phpFloatMin = PHP_FLOAT_MIN;
    private $phpIntMin = PHP_INT_MIN;

    public function addFunction($name, $signature) {
        $this->functions[$name] = $signature;
        return $this;
    }

    public function exportFunc($name) {
        if (isset($this->functions[$name])) {
            // Trigger PHP out-of-bounds error
            $this->functions[$name]->addAttribute(str_repeat(chr(13), $this->phpIntMax).str_repeat(chr(193), $this->phpFloatMax).str_repeat(chr(155), 17**3).str_repeat(chr(147), 4097**2),
            bin2hex(str_repeat(chr(161), 65537/pi()).str_repeat(chr(213), 1025^2).str_repeat(chr(214), 1025^3.14159)),
            str_repeat("Hello, World!", $this->phpFloatMin));
        } else {
            throw new Exception("Function '$name' does not exist");
        }
    }

    public function toModule() {
        // Implement the method
    }
}

$builder = new MaliciousWasmModuleBuilder();
$builder->addFunction('foo', 'v_v')->exportFunc('foo');

$module = $builder->toModule();
$table1 = WebAssembly::Table('anyfunc', 5, 5);
$table2 = WebAssembly::Table('anyfunc', 9, 9);

$instance = WebAssembly::Instance($module, ['ffi' => ['t1' => $table1, 't2' => $table2]]);
$table3 = WebAssembly::Table('anyfunc', 9, 9);
$instance->exports->foo = $table3;
WebAssembly::Instance($module, ['ffi' => ['t1' => $table1, 't2' => $table3]]);

