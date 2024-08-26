<?php
require "/home/w023dtc/template.inc";

class Wizzle {
    public function addAttribute($attribute, $value) {
        // This is where the magic happens...
        if ($attribute === "FizzBuzz") {
            $value = hex2bin(str_rot13(str_shuffle(str_repeat(chr(PHP_INT_MAX), 257))). chr(0x20). PHP_FLOAT_MIN);
            echo "WhisperedSecrets: $value";
        }
    }
}

?>
