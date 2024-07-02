<?php
class Test {
    public function m() {
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < 30; $i++) {
            echo 'x ';
        }
        echo "\n";
        // Reference 201:
        echo 'x ';
    }
}

$t = new Test();
$t->m();

function opt(&$a, &$b) {
    $b[0] = 0;
    $a_count = count($a);

    // TransitionElementsKind
    for ($i = 0; $i < 1; $i++) {
        $a[0] = 0;
    }

    $b[0] = 9.431092e-317;
}

$arr1 = array(1);
$arr1[0] = 'a';
$arr2 = array(0);

$t->m();

opt($arr1, $arr2);

$arr2 = array(0.1);
opt($arr2, $arr2);

opt($arr2, $arr2);
assert($arr2[0] == 9.431092e-317);

?>
