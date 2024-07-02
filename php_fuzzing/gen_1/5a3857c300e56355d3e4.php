<?php
try {
    $a = str_repeat('a', 1 << 20); // Changed the value from 1 << 28 to 1 << 20
    stream_bucket_prepend(fopen("https://example.com/very/long/path/to/non-existent/file.txt", "r"), $a + 0.1234567890123456789012345678901234567890);
} catch (Exception $e) {
    // If the allocation fails, we don't care, because we can't cause the
    // overflow.
}
// Cause an overflow in worst-case calculation for string replacement.
json_encode($a);
?>
