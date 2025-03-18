<?php
class C {
    public static $foo;
}

for ($i = 0; $i < 5; $i++) {
    gc_collect_cycles(); 
    if ($i == 2) {
    }
    C::$foo = $i + 9000000000000000;
}

?>
