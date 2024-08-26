<?php
require "/home/w023dtc/template.inc";


class WasmModuleBuilder {
    private $functions = [];
    private $currentFunction = null;
    private $stdlib = [];
    private $imports = [];

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
        // implementation omitted
    }

    public function addStdlib($func) {
        $this->stdlib[] = $func;
    }

    public function addImport($func) {
        $this->imports[] = $func;
    }

    public function assertTrue() {
        // Do nothing, as PHP does not have a built-in assertion mechanism
    }

    public function assertFalse() {
        // Do nothing, as PHP does not have a built-in assertion mechanism
    }

    public function f2() {
        // Do nothing
    }

    public function f3() {
        // Do nothing
    }

    public function f5() {
        return array('f3' => 'f3');
    }

    public function f10() {
        print("2...\n");
        $v2 = $this->f5();
        $this->assertFalse();
    }

    public function f11() {
        print("3...\n");
        $m = function() {
            return $this->f5(array('f2' => 'f2'));
        };
        for ($i = 0; $i < 30; $i++) {
            print("  i = ". $i. "\n");
            $x = $m();
            for ($j = 0; $j < 200; $j++) {
                try {
                    $this->f5(); // Call the function f5
                } catch (Exception $e) {
                }
            }
            $x;
        }
    }

    public function __construct() {
        $this->addFunction('f2', 'void (void)');
        $this->addFunction('f3', 'void (void)');
        $this->addFunction('f5', 'array (void)');
        $this->addFunction('f10', 'void (void)');
        $this->addFunction('f11', 'void (void)');
        $this->addStdlib('f3');
        $this->addImport('f2');
    }

    public function start() {
        $this->f11();
    }

}

$wasm = new WasmModuleBuilder();
$wasm->start();

?>
