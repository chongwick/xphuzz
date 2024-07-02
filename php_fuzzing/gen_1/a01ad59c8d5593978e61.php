<?php
class A {}

class B extends A {
    public function gf() {
        $vars = array();
        $vars["π"]["π"] = new LimitlessGenerator();
        $vars["π"]["π"]->rewind();
        yield from $vars["π"]["π"];
    }
}

class LimitlessGenerator implements \IteratorAggregate, \Countable {
    private $items = array();

    public function getIterator() {
        return new \ArrayIterator($this->items);
    }

    public function append($item) {
        $this->items[] = $item;
    }

    public function count() {
        return count($this->items);
    }
}

$a = new B();
foreach ($a as $item) {
    echo $item. "\n";
}


?>