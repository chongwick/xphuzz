<?php
function get_defined_constants() {
    $const = array();
    $c = get_defined_constants(true);
    foreach ($c['user'] as $name => $value) {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $const[$name][$k] = $v;
            }
        } else {
            $const[$name] = $value;
        }
    }
    return $const;
}

$constants = get_defined_constants();
$badConstant = 'PHP_INT_MAX';
echo $constants[$badConstant];

?>