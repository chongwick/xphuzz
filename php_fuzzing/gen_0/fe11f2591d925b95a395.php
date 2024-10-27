<?php

$password = str_repeat('a', PHP_INT_MAX);
$hash = 'password_hash';

if (password_verify($password, $hash)) {
    echo "Password is valid";
} else {
    echo "Password is not valid";
}

?>
