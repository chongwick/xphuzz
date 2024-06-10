<?php

use React\Promise\Promise;
use function React\Promise\resolve;

function gen() {
    $alwaysPending = resolve();
    $alwaysPending->then(function() {});
    yield $alwaysPending;
}

$generator = gen();
$generator->current();

?>
