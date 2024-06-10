<?php

function Module() {
    function div_($v6) {
        $v6 = (int)$v6;
    }
    return array('f' => 'div_');
}

$f0 = (Module())['f'];
$v8 = array(0);

$v8[0] = array('get' => function() use ($v8, $f0) {
    return $f0($v8);
});

echo $v8[0];

?>
