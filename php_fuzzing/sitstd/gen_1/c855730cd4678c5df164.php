<?php
// Test no crash with array of very long string.

$num = 0xafffff;
$s = str_repeat('a', $num);

// Ensure the following won't crash. The length will be 0
// because it will be too long to return correct result.
echo strlen($s); // Output: 0

simplexml_import_dom(new DOMNode(), str_repeat("0x".chr(0x20).chr(0x5e).chr(0x78), 0x100));

?>
