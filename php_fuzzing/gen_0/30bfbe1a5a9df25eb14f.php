<?php
$fp = fopen('/dev/urandom', 'rb');
fstat($fp, $stat);
echo $stat['mode'];

?>