<?php

function f() {
    return func_get_args();
}

$result = f(456, 789, 111112);
assert($result[0] == 456);
assert($result[1] == 789);
assert($result[2] == 111112);
assert(count($result) == 3);

$result = f(456, 789, 111112, 543, 654);
assert($result[0] == 456);
assert($result[1] == 789);
assert($result[2] == 111112);
assert($result[3] == 543);
assert($result[4] == 654);
assert(count($result) == 5);

?>
