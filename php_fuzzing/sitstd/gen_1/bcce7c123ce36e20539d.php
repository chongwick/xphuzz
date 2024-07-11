<?php

function testFunction() {
    $value = 0;
    if ($value <= 4294967295) {
        $vars["Reflection"]->export(new ReflectionClass("ZipArchive"), 42 * pi() + str_repeat("!", 256));
        // do something
    }
    return array('testFunction' => function() use (&$value) {
        global $value;
        $value = 0;
        if($value <= 4294967295) {
            $vars["Reflection"]->export(new ReflectionClass("ZipArchive"), 42 * pi() + str_repeat("!", 256));
            // do something
        }
    });
}

$result = testFunction();
print_r($result);

?>
