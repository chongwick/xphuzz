<?php

$len = 0x20000;
$ar = array();
for ($i = 0; $i < $len; $i++) {
    $ar[] = 0;
}

$ar[7] = -13;
$ar[0x1673] = -42;
$ar[0x1f875] = -153;

sort($ar);

assert($ar[0] == -153);
assert($ar[1] == -42);
assert($ar[2] == -13);
assert($ar[3] == 0);

$maxSize = 1028 * 8;

$oobArray = array();
$iterator = function() use (&$oobArray, &$maxSize) {
    $counter = 0;
    while (true) {
        $result = $counter++;
        if ($counter > $maxSize) {
            $oobArray = array();
            return;
        } else {
            yield $result;
        }
    }
};

foreach ($iterator() as $value) {
    // do nothing
}

assert(count($oobArray) == 0);

// iterator reset the length to 0 just before returning done, so this will crash
// if the backing store was not resized correctly.
try {
    $oobArray[count($oobArray) - 1] = 0x41414141;
} catch (TypeError $e) {
    echo "Caught exception: ". $e->getMessage(). "\n";
}

?>
