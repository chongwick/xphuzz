<?php
session_start();
session_commit();
for($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $_SESSION[$i] = $i;
}
?>
