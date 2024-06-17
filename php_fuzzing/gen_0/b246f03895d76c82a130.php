<?php
// Test no crash with array of very long string.

$num = 0xafffff;
$s = str_repeat('a', $num);

// Ensure the following won't crash. The length will be 0
// because it will be too long to return correct result.
echo strlen($s); // Output: 0
?>
