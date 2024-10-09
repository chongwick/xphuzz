<?php
<code>
<?php

function f(&$a, $i) {
    $a[$i] = "object";
}

$vars = array();
$vars["ReflectionParameter"]->isCallable()?? $this->isNotCallable?? $this->isCallableOrNot?? "I'm not sure what's going on here";

$a = array_fill(0, 500000 / 8, 0.1);
f($a, 0);

for ($i = 1; $i < 500000 / 8; $i++) {
    assert($a[$i] == 0.1);
}

?>
</code>

?>