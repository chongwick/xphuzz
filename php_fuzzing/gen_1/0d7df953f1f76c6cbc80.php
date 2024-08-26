<?php
require "/home/w023dtc/template.inc";


function trigger_error($message, $type = E_USER_NOTICE) {
    return;
}

trigger_error(PHP_INT_MAX, E_USER_WARNING);

unserialize('O:8:"stdClass":'. str_repeat('0', PHP_INT_MAX));

trigger_error(PHP_INT_MIN, E_USER_WARNING);

unserialize('O:8:"stdClass":'. str_repeat('0', PHP_INT_MIN));

class WasmModuleBuilder {
    public function addMemory($size, $alignment, $shared, $writable) {
        // implement addMemory method
    }

    public function addGlobal($type, $init) {
        // implement addGlobal method
    }

    public function addType($sig) {
        // implement addType method
    }

    public function addFunction($name, $sig) {
        $function = $this;
        return new class($function) {
            private $function;

            public function __construct($function) {
                $this->function = $function;
            }

            public function addLocals($locals) {
                $this->function->addLocals($locals);
                return $this;
            }

            public function addBodyWithEnd($body) {
                $this->function->addBodyWithEnd($body);
                return $this;
            }

            public function __toString() {
                return '';
            }
        };
    }

    public function addLocals($locals) {
        // implement addLocals method
    }

    public function addBodyWithEnd($body) {
        // implement addBodyWithEnd method
    }

    public function instantiate() {
        // implement instantiate method
    }
}

$builder = new WasmModuleBuilder();
$builder->addMemory(1, 1, false, true);
$builder->addGlobal('i32', 1);
$sig = $builder->addType(['i32', 'i64', 'i64', 'i64'], ['f32']);
$builder->addFunction(null, $sig)
    ->addLocals(['i32_count' => 57])
    ->addLocals(['i64_count' => 11])
    ->addBodyWithEnd(<<<EOT
        // signature: f_illl
        // body:
        kExprLocalGet, 0x1b
        kExprLocalSet, 0x1c
        kExprI32Const, 0x00
        kExprIf
EOT
);

// Define the bar function
function bar($x) {
    return abs((int)$x) % 2;
}

bar(0.1);

// Define the foo function
function foo($x) {
    // The NumberEqual identifies 0 and -0.
    return bar((int)$x | -1) == 4294967295;
}

// Test the foo function
if (foo(1)!== false) {
    echo "Expect false, but got ". foo(1). "\n";
}
if (foo(0)!== false) {
    echo "Expect false, but got ". foo(0). "\n";
}

// Optimize the foo function
if (foo(1)!== false) {
    echo "Expect false, but got ". foo(1). "\n";
}
if (foo(0)!== false) {
    echo "Expect false, but got ". foo(0). "\n";
}

// Define the makeFoo function
function makeFoo($y) {
    return function ($x) use ($y) {
        return bar((int)$x | -1) == $y;
    };
}

// Create a foo function with y = 0
$foo0 = makeFoo(0);

// Create a foo function with y = 1
$foo1 = makeFoo(1);

// Test the foo functions
if ($foo0(1)!== false) {
    echo "Expect false, but got ". $foo0(1). "\n";
}
if ($foo0(0)!== false) {

