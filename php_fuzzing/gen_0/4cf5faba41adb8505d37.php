<?php
function malicious_filter_var_array() {
    $data = array(
        'int' => array(
           'max' => PHP_INT_MAX,
           'min' => PHP_INT_MIN
        ),
        'float' => array(
           'max' => PHP_FLOAT_MAX,
           'min' => PHP_FLOAT_MIN
        )
    );
    return filter_var_array($data, FILTER_VALIDATE_INT | FILTER_VALIDATE_FLOAT);
}

malicious_filter_var_array();
?>
