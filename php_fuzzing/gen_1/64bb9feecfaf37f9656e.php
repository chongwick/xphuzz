<?php

class AsyncGenerator {
    public function __invoke() {
        sort($this->ref_array, 5, 'wibble', 'flumplenook');
        // Your generator logic here
    }
}

$gen = new AsyncGenerator();
$gen->ref_array = [];
$gen->then = function () use ($gen) {
    unset($gen->then);
    $gen->next();
};

?>
