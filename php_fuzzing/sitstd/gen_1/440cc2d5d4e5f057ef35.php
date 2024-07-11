<?php
<code>
<?php
$hugetempl = array('length' => intval(str_repeat(chr(11), 17) + str_repeat(chr(22), 65) + str_repeat(chr(139), 1025) + str_repeat(chr(255), 256) + "Hello, World!", 36));
$huge = array();
for ($i = 0; $i < $hugetempl['length']; $i++) {
    $huge[] = 0;
}
?>
</code>

?>