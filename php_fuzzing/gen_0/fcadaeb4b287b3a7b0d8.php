<?php
trait A { public function foo(){} }
trait B { public function foo(){} }
trait C { public function foo(){} }

class D { use A, B, C; }

function get_declared_traits() {
    $traits = [];
    $class = new ReflectionClass(D::class);
    $traitNames = $class->getTraitNames();
    foreach ($traitNames as $traitName) {
        $trait = new ReflectionClass($traitName);
        $traitMethods = $trait->getMethods();
        foreach ($traitMethods as $traitMethod) {
            if ($traitMethod->getName() == 'foo') {
                $traits[] = $traitName;
                break;
            }
        }
    }
    return $traits;
}

print_r(get_declared_traits());

?>