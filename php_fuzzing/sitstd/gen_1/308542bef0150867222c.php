<?php

function z(array $x = [])
{
    return $x['x'][0]?? 42;
}

function z2(array $x = [])
{
    return $x['x'][0]?? 42;
}

$vars["SplFixedArray"]->offsetExists(5473817451);

z2();
echo'= '.z2();

?>
