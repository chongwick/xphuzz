<?php

// Tests that creating an iterator that shrinks the array populated by Array.from does not lead to out of bounds writes.

$oobArray = array();
$maxSize = 1028 * 8;

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
