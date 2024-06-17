<?php

function testFunction() {
    $value = 0;
    if ($value <= 4294967295) {
        // do something
    }
    return array('testFunction' => function() use (&$value) {
        global $value;
        $value = 0;
        if($value <= 4294967295) {
            // do something
        }
    });
}

$result = testFunction();
print_r($result);

?>
