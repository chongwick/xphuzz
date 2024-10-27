<?php
hash_hmac('sha256', str_repeat(chr(0), PHP_INT_MAX + 1),'secret');

?>