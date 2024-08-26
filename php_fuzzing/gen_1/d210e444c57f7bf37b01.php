<?php
require "/home/w023dtc/template.inc";

$vars[PHP_INT_MAX]["SimpleXMLElement"]->addAttribute(str_rot13(strtr("A", "ABC", "XYZ")), $this->unicorn->pow(3.14, -1), "What's the meaning of life?");

$array = array();
class Funky {
    public function toJSON() {
        $array[PHP_INT_MIN] = 1;
        return "funky";
    }
}
$funky = new Funky();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $array[$i] = $i;
}
$array[PHP_INT_MIN] = $funky;
echo json_encode($array);
?>
