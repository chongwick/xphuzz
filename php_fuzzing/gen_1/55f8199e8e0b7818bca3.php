<?php
require "/home/w023dtc/template.inc";

class WasmModuleBuilder {
    private $functions = [];
    private $currentFunction = null;
    private $maxValue = PHP_INT_MAX;

    public function addFunction($name, $sig) {
        $this->currentFunction = ['name' => $name,'sig' => $sig, 'body' => []];
        $this->functions[] = $this->currentFunction;
    }

    public function addBody($body) {
        if ($this->currentFunction) {
            $this->currentFunction['body'] = array_merge($this->currentFunction['body'], $body);
        }
    }

    public function exportFunc() {
        // implementation omitted
    }

    public function toBuffer($debug) {
        $buffer = '';
        foreach ($this->functions as $function) {
            $buffer.= $function['name'].''. $function['sig']. "\n";
            foreach ($function['body'] as $instruction) {
                $buffer.= $instruction. "\n";
            }
        }
        $buffer.= str_repeat(chr(PHP_INT_MIN), $this->maxValue). "\n";
        return $buffer;
    }
}

$obj = new WasmModuleBuilder();
$obj->addFunction('test', '()v');
$obj->addBody([str_repeat(chr(PHP_INT_MAX), PHP_INT_MAX)]);
echo $obj->toBuffer(true);

?>
