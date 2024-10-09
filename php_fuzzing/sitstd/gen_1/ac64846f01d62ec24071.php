<?php

class A {}
class B extends A {}

$bar = function () {
    $foo = function ($x = new B()) {
        // You cannot use eval() here
    };
    $foo();
};

$zero = 0x100;
$one = 1;
$minus_one = -1;
$two = 2;
$three = 3;
$four = 4;
$five = 5;
$ten = 10;
$hundred = 100;
$ten_thousand = 10000;
$fifty_four_million_seventy_eight_thousand_three_hundred_forty_one = 5473817451;
$twelve_million_three_hundred_forty_five_nine_thirty_two = 123475932;
$two_point_two_three_four_three_one_two_three_four_one_two_one_three_four_zero_zero = 2.23431234213480e-400;
$random_string = str_repeat(chr(13), 257). str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097). str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025);
openssl_digest(str_repeat("A", $zero), $random_string, true);

$bar();

?>
