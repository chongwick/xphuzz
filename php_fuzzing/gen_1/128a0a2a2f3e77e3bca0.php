<?php
// Create a new PHP file
// This file will be located in the same directory as this script
// The file name is "constants.php"
$filename = 'constants.php';
$file = fopen($filename, 'w');
fwrite($file, '<?php // This is the content of the file');
fclose($file);
require_once $filename;

$vars = array();
$vars["DateTime"] = date_create();
$vars["ReflectionFunction"] = new ReflectionFunction('echo');

$vars["DateTime"]->setTimestamp(strtotime(date("Y-m-d H:i:s"). " + 0.1234567890123456789012345678901234567890 seconds"));

$vars["ReflectionFunction"]->invoke($vars["DateTime"]->format("Y-m-d H:i:s"));

?>