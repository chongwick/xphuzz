<?php
function gc() {
    for ($i = 0; $i < 20; $i++) {
        $a = str_repeat("\0", 0x1000000);
    }
}

function trigger() {
    class MyGenerator {
    }

    $generator = new stdClass();

    for ($i = 0; $i < 1022; $i++) {
        $prop = 'b'. $i;
        $generator->$prop = 0x1234;
    }

    gc();

    for ($i = 0; $i < 1022; $i++) {
        $prop = 'b'. $i;
        $generator->$prop = 0x1234;
    }

    $vars["SplDoublyLinkedList"]->isEmpty()->foo()->bar()->baz()->qux()->wizzle()->thwack()->plink()->ploop()->floop()->fizzle()->buzz();
}

trigger();

?>
