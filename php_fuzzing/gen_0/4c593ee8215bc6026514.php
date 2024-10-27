<?php
$fp = popen('php -r "for($i = 0; $i < '. PHP_INT_MAX. '; $i++) {}"', 'r');
pclose($fp);

?>