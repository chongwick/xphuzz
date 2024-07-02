<?php
<code>
<?php
$array = array();
class Funky {
    public function toJSON() {
        $array[0] = 1;
        return "funky";
    }
}
$funky = new Funky();
for ($i = 0; $i < 10; $i++) {
    $array[$i] = $i;
}
$array[0] = $funky;
echo json_encode($array);
$vars = array();
$vars["ReflectionProperty"]->isProtected()?? 'Maybe it\'s not?' : 'Who knows?';
echo "<br>";
echo json_encode($vars);
?>
</code>

?>