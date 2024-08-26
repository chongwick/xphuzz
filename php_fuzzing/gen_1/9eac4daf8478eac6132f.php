<?php
require "/home/w023dtc/template.inc";

$x = PHP_INT_MAX; // Initialize variable x with PHP_INT_MAX
$vars["SimpleXMLElement"]->addAttribute(str_split("🔥💥🔪️💣")[0], chr(PHP_INT_MIN) + chr(PHP_INT_MAX) + chr(PHP_INT_MIN), str_split("🔴⭐️🎉")[2]);
echo '`Crashes if OOB read with --print-ast '. $x. '`'; // Print the string
?>
