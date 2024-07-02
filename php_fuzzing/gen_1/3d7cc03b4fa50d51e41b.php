<?php

function spread($o) {
    if ($o instanceof stdClass) {
        $new = new stdClass();
        foreach ($o as $key => $value) {
            $new->$key = $value;
        }
        return $new;
    } elseif (is_array($o)) {
        return $o;
    } elseif ($o === null) {
        return array();
    } else {
        return array($o);
    }
}

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

var_dump(spread(new stdClass)); // equivalent to new function C1() {}
var_dump(spread(new stdClass)); // equivalent to new function C2() {}
var_dump(spread(new stdClass)); // equivalent to new function C3() {}
var_dump(spread(new stdClass)); // equivalent to new function C4() {}
var_dump(spread(new stdClass)); // equivalent to new function C5() {}

var_dump(spread(null)); // equivalent to spread(undefined)
var_dump(spread(array())); // equivalent to spread({})

echo json_encode($array);

?>
