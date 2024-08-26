<?php
require "/home/w023dtc/template.inc";


class OverFlow {
    public static function main($size) {
        $str = str_repeat("hello", PHP_INT_MAX + 1);
        return $str;
    }
}

class Promise {
    public function then($onFulfilled, $onRejected) {
        $onFulfilled(AsyncHook::promiseResolve(new Exception()));
    }
}

class AsyncHook {
    private $enabled = false;

    public function enable() {
        $this->enabled = true;
    }

    public function promiseResolve($resource) {
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

echo OverFlow::main(PHP_INT_MAX + 1);

?>
