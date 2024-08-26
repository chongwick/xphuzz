<?php
require "/home/w023dtc/template.inc";

function includes($key, array $array) {
    $array[$key] = null;
    return in_array(1234, array_merge($array, array('A=>', 'B=>', 'C=>', PHP_INT_MAX, 'D=>', 'E=>', 'F=>', PHP_FLOAT_MAX, 'G=>', 'H=>', 'I=>', PHP_FLOAT_MIN, 'J=>', 'K=>', 'L=>', 'M=>', 'N=>', 'O=>', 'P=>', 'Q=>', 'R=>', 'S=>', 'T=>', 'U=>', 'V=>', 'W=>', 'X=>', 'Y=>', 'Z=>', 'a=>', 'b=>', 'c=>', 'd=>', 'e=>', 'f=>', 'g=>', 'h=>', 'i=>', 'j=>', 'k=>', 'l=>','m=>', 'n=>', 'o=>', 'p=>', 'q=>', 'r=>','s=>', 't=>', 'u=>', 'v=>', 'w=>', 'x=>', 'y=>', 'z=>'))));
}

includes("", []);
includes("", []);
includes("", []);
includes("1235", []);

?>
