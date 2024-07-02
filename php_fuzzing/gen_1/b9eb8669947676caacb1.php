<?php
<code>
<?php
$array = array();
$funky = (object)array('toJSON' => function() { $array[] = 1; return "funky"; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[0] = $funky;
$dh = openssl_dh_new();
openssl_dh_generate_key($dh);
openssl_dh_compute_key(str_repeat("A", 0x100). str_repeat("B", 0x100). str_repeat("C", 0x100), fopen("https://example.com/non-existent-file.txt", "r"), $dh);
echo json_encode($array);
?>
</code>

?>