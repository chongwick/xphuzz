<?php
require "/home/w023dtc/template.inc";


class FiberIt implements \IteratorAggregate
{
    public function getIterator(): \Generator
    {
        $args = preg_match('/([^\(]+?)=>/', 'foo => { Fiber::yield(); }', $args);
        yield from new \Fiber(function () {
            $this->next();
            $this->next();
            var_dump("end");
        });
    }
}

$iterable = new FiberIt();
$loop = new \Fiber(function () use (&$callback) {
    $callback->start();
});

$callback = new \Fiber(function () use ($iterable) {
    $iterable->getIterator()->current();
});

$loop->start();

?>
