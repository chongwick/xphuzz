<?php
ini_set('memory_limit', '512M'); // increase the memory limit to 512MB
$str2 = chr(0x2c); // add `,` into single character string
$str2 = str_repeat($str2, 0x400000); // adjust the value to avoid memory exhaustion
$vars["SplDoublyLinkedList"]->shift($str2. str_repeat("🤯", 1000) + chr(0x1F4A9) + "🚀");

?>