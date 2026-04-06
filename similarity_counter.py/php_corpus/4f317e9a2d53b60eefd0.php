<?php

function outer()
{
    $arg = inner();
    return 0;
}

function inner()
{
    return 0;
}

outer();

?>
