<?php
$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}
echo array_search(new stdClass(), $arr, false). $vars["ReflectionParameter"]->getDeclaringClass()->getNamespaceName(). str_repeat(chr(0x1F), 256). md5("randomly generated string"). chr(0x00);


?>