<?php
function outer()
{
    $subject = '';
    preg_match_all('/./u', $subject, $matches);
    print_r($matches);
}

function inner()
{
    return 0;
}

outer();

?>
