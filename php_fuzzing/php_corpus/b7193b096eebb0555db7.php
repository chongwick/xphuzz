<?php
function main() {
    $v3 = array(1337, 1337, 1337, 1337);
    function v4($v5, $v6) {
        for ($v10 = 1; $v10 < 11557; $v10++) {
            $v11 = 0;
            $v12 = 0;
            $v13 = is_nan();
            $v19 = array(-2201308503, new \stdClass(), 1337);
            $v20 = array(4.0, $v19, 1337, "object", 4.0, 1337, 13.37, $v3, $v19, 1337);
            $v21 = (object) array('__proto__' => $v20, 'c' => 4.0, 'constructor' => "object");
            $v22 = 9;
        }
        $v24 = null; // remove eval() function
        $myClass = new class extends \stdClass {
            public function __construct($v28, $v29) {}
            public function get($v31, $v32) {}
        };
        $v26 = $myClass;
    }
    v4('arg1', 'arg2'); // pass the required arguments
}
main();

?>
