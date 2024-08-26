<?php
require "/home/w023dtc/template.inc";


class AsyncHook {
    private $enabled = false;

    public function enable() {
        $this->enabled = true;
    }

    public function promiseReject($resource) {
        if ($this->enabled) {
            throw new Exception();
        }
    }
}

class Object {
    public function __toString() {
        PHP_INT_MAX;
    }
}

function defineSetter($o) {
    return $o;
}

function testfn($f) {
    return $f;
}

// Call the function after defining it
testfn(defineSetter(new Object()));

// This will trigger the CVE
$asyncHook = new AsyncHook();
$asyncHook->enable();

function foo() {
    yield from [1];
}

$generator = foo();
foreach ($generator as $x) {
    // do nothing
}

?>
