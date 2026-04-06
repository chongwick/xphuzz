<?php

function assertIsWasmSharedMemory($memory) {
    if (!is_object($memory)) {
        throw new Error("Memory is not an object");
    }
    if (!($memory instanceof WebAssemblyMemory)) {
        throw new Error("Object is not WebAssembly.Memory");
    }
    if (!($memory->buffer instanceof SharedArrayBuffer)) {
        throw new Error("Memory.buffer is not a SharedArrayBuffer");
    }
    if (!is_object_freeze($memory->buffer)) {
        throw new Error("Memory.buffer not frozen");
    }
}

function assertTrue($value, $msg) {
    if (!$value) {
        throw new Error("Error: ". $msg);
    }
}

function assertEquals($expected, $actual, $message = '') {
    if ($expected!== $actual) {
        throw new Error("Assertion failed: ". $message);
    }
}

function assertTraps($trap, $code) {
    try {
        $code();
        throw new Error("Expected trap");
    } catch (TrapException $e) {
        if ($e->getTrap()!== $trap) {
            throw new Error("Unexpected trap");
        }
    }
}

class WebAssemblyMemory {
    public $buffer;
    public $initial;
    public $maximum;
    public $shared;

    public function __construct($initial, $maximum, $shared) {
        $this->initial = $initial;
        $this->maximum = $maximum;
        $this->shared = $shared;
    }

    public function grow($size) {
        if ($this->buffer === null) {
            $this->buffer = new SharedArrayBuffer($this->initial * 1024 * 1024);
        }
        $this->buffer = new SharedArrayBuffer($this->buffer->byteLength + $size * 1024 * 1024);
        return $size;
    }
}

class WebAssembly {
    public static function Memory($initial, $maximum, $shared) {
        return new WebAssemblyMemory($initial, $maximum, $shared);
    }
}

class WasmModuleBuilder {
    public function addImportedMemory($name, $type, $initial, $maximum, $shared) {
        // To be implemented
    }
}
