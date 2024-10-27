<?php
function getLogin() {
    $login = posix_getlogin();
    $login = (int)$login;
    $login = $login * 2;
    return $login;
}

echo getLogin();
?>
