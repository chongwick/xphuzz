<?php
<code>
<?php
class WasmModuleBuilder {
    public $currentFunction;

    public function addGlobal($type, $value) {
        // implementation
    }

    public function addType($signature) {
        // implementation
    }

    public function addFunction($name, $signature) {
        $function = new stdClass();
        $function->name = $name;
        $function->signature = $signature;
        $function->locals = [];
        $function->body = [];
        $this->currentFunction = $function;
        return $function;
    }

    public function addLocals($type, $count) {
        $this->currentFunction->locals[] = ['type' => $type, 'count' => $count];
    }

    public function addBodyWithEnd($body) {
        $this->currentFunction->body = array_merge($this->currentFunction->body, $body);
    }

    public function instantiate() {
        // implementation
    }
}

$a = array(1, 2);

function f($skip) {
    $wasm = new WasmModuleBuilder();
    $wasm->addFunction('f', '() -> i32');
    $wasm->addLocals('i32', 1);
    $wasm->addBodyWithEnd([['i32.const', 0], ['call', 0]]);
    g(null, $skip);
}

function g($x, $skip) {
    global $wasm;
    global $a;
    if ($skip) {
        $wasm->addFunction('g', '(i32) ->');
        $wasm->addLocals('i32', 1);
        $wasm->addBodyWithEnd([['return']]);

        $wasm->addFunction('main', '() -> i32');
        $wasm->addLocals('i32', 1);
        $wasm->addBodyWithEnd([['call', 0]]);
    } else {
        $wasm->addFunction('g', '(i32) -> i32');
        $wasm->addLocals('i32', 1);
        $wasm->addBodyWithEnd([['i32.const', $a[$x + 1]], ['return']]);
    }
}

g(0, false);
g(0, false);
f(true);
f(true);
f(false);

?>
</code>

?>