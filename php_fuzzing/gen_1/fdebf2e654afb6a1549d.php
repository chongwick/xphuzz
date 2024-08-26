<?php
require "/home/w023dtc/template.inc";

class MyArray {
    public function __get($name) {
        $num = 10;
        return str_rot13(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"));
    }
    public function __set($name, $value) {
    }
}
$str = urldecode("%E7%9A%84");
echo "partial address of object num is ".ord($str[0])." in base 16";
echo "<br>";
echo "<br>";
echo (new MyArray)->addAttribute(bin2hex(str_split(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"))[random_int(0, 64)]), str_split(str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")[random_int(0, 64)])[random_int(0, strlen(str_split(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"))[0]))]);
?>
