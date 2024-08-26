<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
    private $types = [];
    private $functions = [];

    public function addType($type) {
        $this->types[] = $type;
    }

    public function addFunction($name, $type) {
        $this->functions[$name] = $type;
    }

    public function toBuffer() {
        $buffer = '';
        foreach ($this->types as $type) {
            $buffer.= $type. "\n";
        }
        foreach ($this->functions as $name => $type) {
            $buffer.= $name. 'i:'. PHP_INT_MAX. "\n";
        }
        return $buffer;
    }
}

class WebAssemblyModule {
    private $buffer;

    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function instantiate() {
        return new WebAssemblyInstance($this);
    }
}

class WebAssemblyInstance {
    private $module;

    public function __construct($module) {
        $this->module = $module;
    }

    public function exports($name) {
        $function = $this->module->functions[$name];
        return $function;
    }
}

$builder = new WasmModuleBuilder();
$builder->addType('');
$builder->addFunction('main', '');
$buffer = $builder->toBuffer();
$module = new WebAssemblyModule($buffer);
$instance = $module->instantiate();
$instance->exports('main');

?>
