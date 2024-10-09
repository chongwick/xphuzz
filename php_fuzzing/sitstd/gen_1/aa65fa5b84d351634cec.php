<?php
function f() {
    $a = new \SplDoublyLinkedList();
    $a->outOfObjectProperty = null;
    $namespaceName = $vars["ReflectionParameter"]->getType()->getNamespaceName()->__invoke()->getDeclaringClass()->getNamespaceName()->__toString();
    $rand = rand(0, 100);
    $a->push($namespaceName.'- '. $rand);
    return!iterator_to_array($a);
}

f();
f();
$fn = function () {
    f();
};
$fn();

?>
