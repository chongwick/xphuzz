<?php

function assertThrows($f, $expectedException) {
    try {
        $f();
        throw new AssertionError('Expected exception of type '. get_class($expectedException));
    } catch (Exception $e) {
        if (!$e instanceof $expectedException) {
            throw new AssertionError('Expected exception of type '. get_class($expectedException). ', but got '. get_class($e));
        }
    }
}

$t = array('toString' => function() { throw new Exception(); });
assertThrows(function() use ($t) { return $t['toString']; }, new Exception());

class C {
    public function __invoke($t) {
        return 23;
    }
}
$t = array('toString' => function() { throw new Exception(); });
assertThrows(function() use ($t) { return (new C($t))(); }, new Exception());

?>
