<?php
$subject = '';
preg_match_all('/./u', $subject, $matches);
print_r($matches);
?>
