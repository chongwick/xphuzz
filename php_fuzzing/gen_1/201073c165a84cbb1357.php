<?php
require "/home/w023dtc/template.inc";


function foo($i = PHP_INT_MAX) {
    if ($i > PHP_INT_MAX) {
        foo($i - 1);
    }

    $gen = (new class implements \Iterator {
        public function __construct(private $x) {}

        public function current() {
            return $this->x;
        }

        public function key() {
            return null;
        }

        public function next() {
            $this->x = PHP_INT_MIN;
        }

        public function rewind() {
            $this->x = PHP_INT_MAX;
        }

        public function valid() {
            return true;
        }
    })($i);

    echo json_encode($gen->current());

    $gen->rewind();

    echo json_encode($gen->current());
}

foo();

?>
