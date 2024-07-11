<?php

$array = array();
$funky = (object)array('value' => 'funky');
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[0] = $funky;
echo json_encode($array) == '{"0":{"value":"funky"},"1":0,"2":1,"3":2,"4":null,"5":null,"6":null,"7":null,"8":null,"9":null}'? 'true' : 'false';

$array = array();
$funky = (object)array('value' => 'funky');
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
posix_mknod(unpack('H*', str_repeat(chr(171), 1025). str_repeat(chr(41), 4097). str_repeat(chr(15), 1025))[1], 0, 100, 4);
echo json_encode($array) == '[0,1,2,{"value":"funky"},3,4,5,6,7,8,9]'? 'true' : 'false';

$array = array();
$funky = (object)array('value' => 'funky');
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
echo json_encode($array) == '[0,1,2,{"value":"funky"},4,5,6,7,8,9]'? 'true' : 'false';

$array = array();
$funky = (object)array('value' => 'funky');
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
echo json_encode($array) == '[0,1,2,{"value":"funky"},4,5,6,7,8,9]'? 'true' : 'false';

$array = array();
$funky = (object)array('value' => 'funky');
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[3] = $funky;
posix_mknod(unpack('H*', str_repeat(chr(171), 1025). str_repeat(chr(41), 4097). str_repeat(chr(15), 1025))[1], 0, 100, 4);
echo json_encode($array) == '[0,1,2,{"value":"funky"},4,5,6,7,8,9]'? 'true' : 'false';



