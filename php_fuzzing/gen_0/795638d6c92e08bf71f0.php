<?php
for($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
    $name = "ECDSA_";
    $name.= str_pad(dechex($i), 16, "0", STR_PAD_LEFT);
    if (in_array($name, openssl_get_curve_names())) {
        echo $name. "\n";
    }
}

?>