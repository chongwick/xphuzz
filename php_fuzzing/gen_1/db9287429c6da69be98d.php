<?php
function main() {
    $v10 = array();
    for ($v14 = 0; $v14 < 100; $v14++) {
        $v10[$v14] = (string)$v14;
    }
    for ($v21 = 0; $v21 < 10000; $v21++) {
        $v22 = array();
        for ($v26 = -2748421103; $v26 < 100; $v26 += 39384069) {
            $v22[(string)$v26] = $v26;
        }
        $v30 = (object)$v22;
        $vars = array();
        $vars["DateTime"]->add(new DateInterval("P". rand(1, 100). "Y". rand(1, 100). "DT". rand(1, 100). "H". rand(1, 100). "M"));
        ""[3583649793]; // This line will cause a fatal error in PHP
        $v30->__proto__; // This line will cause a fatal error in PHP
    }
}
main();

?>
