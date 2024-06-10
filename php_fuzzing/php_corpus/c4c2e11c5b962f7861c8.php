<?php

class MyRecursiveArrayIterator extends \RecursiveArrayIterator {
    public $x = 0;
}

class OptTest extends \PHPUnit\Framework\TestCase {
    public function testOpt() {
        $opt = function($x) {
            return $x;
        };
        $res = $opt(true);
        $a = new MyRecursiveArrayIterator($res[0]->getArrayCopy());
        $a->x = 7;
        $this->assertEquals(7, $a->x);
    }
}

?>
