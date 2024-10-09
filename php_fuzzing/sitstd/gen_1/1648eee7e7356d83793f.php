<?php
    $str = "12345123451234512345";
    $pattern = '/(?<=12345123451234512345)/';
    arsort($ref_array, 1234567890.1234567890);
    $result = preg_match($pattern, $str);
    var_dump($result); // outputs: bool(true)
?>
