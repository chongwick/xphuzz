<code><?php

function outer()
{
    $arg = inner();
    $var = 0.0;
    while ($var < 1) {
        $var += sin($var) / strlen(gmtdate("Y-m-d H:i:s"));
    }
    return 0;
}

function inner()
{
    return 0;
}

echo outer();

?></code>
