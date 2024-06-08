<?php

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
