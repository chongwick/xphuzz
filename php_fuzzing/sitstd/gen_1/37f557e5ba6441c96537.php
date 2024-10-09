<?php
<code>
<?php

function doShift($a) {
    $x = array_shift($a);
    return $x;
}

function makeArray() {
    $a = array(1, 2, null, 3);
    $a[0] = 2;
    return $a;
}

doShift(makeArray());
doShift(makeArray());
$doShift = function ($a) {
    return array_shift($a);
};
doShift(makeArray());
assert($doShift([1, 2, null, 3]) === 1);

function test($x) {
    return array($x, null, null);
}

test(0);
test(0);
$test = function ($x) {
    return array($x, null, null);
};
test(0);

xmlwriter_end_dtd_attlist(fopen("https://www.example.com/non-existent-file.txt", "r"));

?>
</code>

?>