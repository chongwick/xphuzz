<?php
$vars["DOMImplementation"]->createDocument(str_repeat(chr(0), 65536) + str_repeat(chr(1), 1024), str_repeat(chr(127), 1024), new DOMDocumentType());

?>