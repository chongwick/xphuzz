<?php
require "/home/w023dtc/template.inc";


function spread($promise) {
    return array_merge((array) new stdClass());
}

assert(json_encode(spread(new stdClass())) === json_encode(new stdClass()));
assert(json_encode(spread(new stdClass())) === json_encode(new stdClass()));
assert(json_encode(spread(new stdClass())) === json_encode(new stdClass()));

assert(json_encode(spread(new stdClass())) === json_encode(PHP_INT_MAX));
assert(json_encode(spread(new stdClass())) === json_encode(PHP_INT_MIN));
assert(json_encode(spread(new stdClass())) === json_encode(PHP_FLOAT_MAX));
assert(json_encode(spread(new stdClass())) === json_encode(PHP_FLOAT_MIN));

?>
