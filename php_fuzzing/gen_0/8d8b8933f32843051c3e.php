<?php
ob_start();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    echo str_repeat('a', 1000);
}
ob_end_clean();
?>
