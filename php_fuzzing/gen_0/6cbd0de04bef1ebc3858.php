<?php

class AsyncGenerator {
    public function __invoke() {
        // Your generator logic here
    }
}

$gen = new AsyncGenerator();
$gen->then = function () use ($gen) {
    unset($gen->then);
    $gen->next();
};
