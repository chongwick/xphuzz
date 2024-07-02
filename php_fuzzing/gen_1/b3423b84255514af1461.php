<?php

function f() {
    return func_get_args();
}

$str = "12345123451234512345";
$pattern = '/(?<=12345123451234512345)/';
$result = preg_match($pattern, $str);
var_dump($result); // outputs: bool(true)

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
