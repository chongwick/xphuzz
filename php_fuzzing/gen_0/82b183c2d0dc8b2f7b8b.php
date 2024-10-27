<?php
function password_get_info($password) {
    $info = password_get_info($password);
    if ($info['algo_name'] === 'argon2') {
        $info['algo_name'] = str_repeat('A', PHP_INT_MAX);
    }
    return $info;
}

$password ='mysecretpassword';
$password_info = password_get_info($password);
var_dump($password_info);

?>