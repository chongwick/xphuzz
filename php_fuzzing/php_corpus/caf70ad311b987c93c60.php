<?php

$v = array_fill(0, 1000000, 100);

$v4 = array();

$v[1000000] = 'a'; // grow $v to large size
array_fill(0, 1000000, 0); //fill up $v
array_splice($v, PHP_INT_MAX, 0, array(5, $v4, 4, 3)); // infinity is bigger than array length

for ($i = 0; $i < 1000; $i++) {
    $v = array_values($v); // reset the array keys
    if (is_array($v)) {
        f1($v); // pass the array to the function
    }
}

function f1($v) {
    if (is_array($v)) {
        array_shift($v);

        // causes both memory and cpu pressure, laaaarge string that keeps json parser busy for a while
        try {
            json_decode(
                str_repeat(chr(29).chr(72), 1025) 
             . str_repeat(chr(65).chr(41), 4097) 
             . str_repeat(chr(106).chr(59).chr(71), 65537) 
             . str_repeat(chr(123).chr(2).chr(39), 4097) 
             . str_repeat(chr(126).chr(36), 4097) 
             . str_repeat(chr(67), 1025) 
             . str_repeat(chr(21).chr(100), 1025) 
             . str_repeat(chr(82).chr(56).chr(119), 257) 
             . str_repeat(chr(14).chr(99).chr(106), 1025)
            );
        } catch (Exception $e) {
        }

        var_dump($v);
    }
}

?>
