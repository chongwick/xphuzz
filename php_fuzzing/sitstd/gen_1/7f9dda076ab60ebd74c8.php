<?php
class C {
    public static $foo;
}

for ($i = 0; $i < 5; $i++) {
    gc_collect_cycles(); 
    if ($i == 2) {
        stream_bucket_new(fopen("https://example.com/non-existent-file.txt", "r"), str_repeat(chr(53), 65537) + str_repeat(chr(105), 17) + str_repeat(chr(6), 257) + str_repeat(chr(0), 100000) + "Hello, World!");
    }
    C::$foo = $i + 9000000000000000;
}

?>
