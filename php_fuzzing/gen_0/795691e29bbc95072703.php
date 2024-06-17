<?php
$array = array();
$funky = (object)array('toJSON' => function() { $array[] = 1; return "funky"; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[0] = $funky;
echo json_encode($array);
?>
