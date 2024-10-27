<?php
for($i = 0; $i <= PHP_INT_MAX; $i++) {
    $str = str_pad($i, 20, '0', STR_PAD_LEFT);
    str_increment($str);
}

?>