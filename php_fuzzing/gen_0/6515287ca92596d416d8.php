<?php

// Check that we do appropriate used/unused field accounting
$promise = new stdClass();
$promise->then = function() {};

function spread() {
    global $promise;
    return array_merge((array) $promise);
}

assert(json_encode(spread()) === json_encode($promise));
assert(json_encode(spread()) === json_encode($promise));
assert(json_encode(spread()) === json_encode($promise));

$spread = function() {
    global $promise;
    return array_merge((array) $promise);
};
assert(json_encode($spread()) === json_encode($promise));

?>
