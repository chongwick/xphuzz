<?php

class MyClass
{
    public function __wakeup()
    {
        while (true) {
            echo "Hello, world!";
        }
    }
}

$myObject = unserialize('O:9:"MyClass":1:{s:7:"__sleep";a:0:{}s:4:"__w";}'. str_repeat('a:1:{s:7:"__w";}', 10000));
