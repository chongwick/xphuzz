<?php

function z(array $x = [])
{
    return $x['x'][0]?? 42;
}

function z2(array $x = [])
{
    return $x['x'][0]?? 42;
}

z2();
echo'= '.z2();

?>
