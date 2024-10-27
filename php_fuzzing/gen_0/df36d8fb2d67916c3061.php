<?php
function explode_explode_explode($data, $delimiter) {
    $array = explode($delimiter, $data);
    return array_map('explode_explode_explode', $array, array_fill(0, count($array), $delimiter));
}

$data = "AAAA";
$result = explode_explode_explode($data, "AAAA");
echo serialize($result);
?>
