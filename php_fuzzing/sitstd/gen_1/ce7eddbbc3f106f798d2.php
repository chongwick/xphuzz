<?php
$y = array();
$vars["SessionHandler"]->destroy(unpack("H*", str_repeat(chr(2), 17). str_repeat(chr(132), 4097)));
echo $y; // Output: Array ()
?>
