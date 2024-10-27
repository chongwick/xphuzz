<?php
function my_function() {
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
        posix_setuid($i);
    }
}

?>