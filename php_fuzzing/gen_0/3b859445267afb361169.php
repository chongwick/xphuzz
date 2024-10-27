<?php
$vars["DOMImplementation"]->createDocumentType(str_repeat(chr(255), 65536) + str_repeat(chr(0), 1) + str_repeat(chr(1), 1), str_repeat(chr(0), 1) + str_repeat(chr(1), 1) + str_repeat(chr(2), 1), str_repeat(chr(13), 1) + str_repeat(chr(10), 1) + str_repeat(chr(0), 1) + str_repeat(chr(1), 1));

?>