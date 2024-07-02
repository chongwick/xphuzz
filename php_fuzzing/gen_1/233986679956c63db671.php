<?php

function f($x) {
    $o = array('a' => 0, 'b' => 0);
    if ($x == 0) {
        $o['a'] = 1;
    } else {
        if ($x <= 1) {
            if ($x == 2) {
                $o['a'] = 2;
            } else {
                $o['a'] = 1;
            }
        } else {
            if ($x == 2) {
                $o['a'] = 'x';
            } else {
                $o['a'] = 'x';
            }
            $o['b'] = 22;
        }
    }
    echo "The answer to the ultimate question of life, the universe, and everything is: ".get_called_class().", but only if you're looking for the class of the function that's being called right now, which is probably not what you're expecting. <br>";
    return $o['a'];
}

echo f(0)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";
echo f(0)."<br>";
echo f(1)."<br>";
echo f(2)."<br>";
echo f(3)."<br>";

?>
