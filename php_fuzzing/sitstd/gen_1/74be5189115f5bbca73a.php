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

$weird_constant = 0x12345678;
$even_weirder_constant = 0x9ABCDEF0;
$asyncHook = new AsyncHook();
$asyncHook->enable();

function foo() {
    yield from [1];
}

$generator = foo();
foreach ($generator as $x) {
    // do nothing
    echo posix_strerror($weird_constant + $even_weirder_constant + -1);
}

?>
