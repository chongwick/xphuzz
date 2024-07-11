<?php
<code>
<?php
// Test no crash with array of very long string.
$num = 0xafffff;
$s = str_repeat('a', $num);

class C {
    public static $foo;
}

for ($i = 0; $i < 4; $i++) {
    if ($i == 2) {
        // There is no direct equivalent of %OptimizeOsr() in PHP, it seems to be a V8-specific optimization flag.
        // You can add a custom function or a placeholder here.
    }
    C::$foo = strlen($s); // Output: 0
}

?>
</code>

?>