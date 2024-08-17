<?php
// Create a new PHP file
// This file will be located in the same directory as this script
// The file name is "constants.php"
$filename = 'constants.php';
$file = fopen($filename, 'w');
fwrite($file, '<?php // This is the content of the file');
fclose($file);
require_once $filename;
?>
