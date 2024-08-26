<?php
require "/home/w023dtc/template.inc";


function asyncGenerator() {
    for ($i = PHP_INT_MAX; $i >= PHP_INT_MIN; $i--) {
        yield $i;
    }
}

$gen = asyncGenerator();
$result = json_decode($gen->send(null), true);

echo $result['0'];
echo $result[PHP_FLOAT_MAX];
echo $result[PHP_FLOAT_MIN];
echo $result[' '];
echo $result[PHP_INT_MAX];
echo $result[PHP_INT_MIN];
echo $result['D'];
echo $result['B'];
echo $result['-1'];
echo $result['A'];
echo $result['C'];

?>
