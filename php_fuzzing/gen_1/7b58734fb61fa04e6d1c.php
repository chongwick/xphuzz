<?php
<code>
<?php
class C {
    public $c = array('c' => 'c');
}

$array = array();
$funky = (object)array('toJSON' => function() { $array[] = 1; return "funky"; });
for ($i = 0; $i < 10; $i++) {
    $array[] = $i;
}
$array[0] = $funky;
$c = new C();
$array[] = $c;
echo json_encode($array);
?>
</code>

?>