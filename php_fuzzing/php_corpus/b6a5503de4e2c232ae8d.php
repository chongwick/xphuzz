<?php
function f($i) {
    if ($i == 0) {
        class Derived extends stdClass {
            function __construct() {
                parent::__construct();
                for ($j = 0; $j < 524286; $j++) {
                    $this->a = 1;
                }
            }
        }
        return 'Derived';
    }

    $className = f($i - 1);
    if (!class_exists($className)) {
        class $className extends stdClass {
            public function __construct() {
                parent::__construct();
                for ($j = 0; $j < 1048576; $j++) {
                    $this->a = 1;
                }
            }
        }
    }
    return $className;
}

$a = f(32767);
$$a = new $a;
var_dump($$a);

?>
