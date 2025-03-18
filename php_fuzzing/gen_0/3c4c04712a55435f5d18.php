<?php
    $str = "12345123451234512345";
    $pattern = '/(?<=12345123451234512345)/';
    $result = preg_match($pattern, $str);
    var_dump($result); // outputs: bool(true)
?>
