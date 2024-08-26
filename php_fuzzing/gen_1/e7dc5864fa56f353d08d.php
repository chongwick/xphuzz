<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
    public function __construct() {
        $this->addGlobal('phpFloatMin', PHP_FLOAT_MIN);
    }

    public function addType($signature) {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $this->addGlobal("global_". $i, $i);
        }
    }

    public function instantiate() {
        $this->addFunction('crash', 'f32 (f32)');
        $this->addLocals(['x: f32']);
        $this->addBody('
            local.get x
            f32.convert_s/f64
            return
        ');
    }
}

$builder = new WasmModuleBuilder();
$builder->instantiate();

?>
