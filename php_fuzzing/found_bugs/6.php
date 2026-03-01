<?php
class Test implements \IteratorAggregate
{
    public function getIterator(): \Generator
    {
        yield 'foo';
            Fiber::suspend();
    }
}
function f() {
    yield from new Test();
}
$iterable = f();
$loop = new Fiber(function () use (&$callback) {
    $callback->start();
});
$callback = new Fiber(function () use ($iterable) {
    while (true) {
        $iterable->next();
    }
});
$loop->start();
?>
