<?php
<code>
<?php

$a = array(0, 1);
$o = (object) array(
    'valueOf' => function() {
        $GLOBALS['a'] = array(0 => 1);
        return 2;
    }
);

$a[] = 2;

xmlwriter_start_document(fopen("https://example.com/non-existent-file.txt", "r"),
implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, array_merge(range(0, 255), array(0x10000, 0x10001, 0x10002, 0x10003))),
str_repeat("%s%x%n", 0x1000000),
str_repeat("%s%x%n", 0x1000000));

echo array_search(5, $a, false);

?>
</code>

?>