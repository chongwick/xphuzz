<?php
function __f_1() {
  $myvar = 'level1';
  if (true) {
    $myvar = 'level2';
  }
}

class Realm {
    public function detachGlobal($id) {
        // Your code here
    }

    public function getGlobal($id) {
        // Your code here
    }
}

$realm = new Realm();
$realm->detachGlobal(1);
$globalVar = $realm->getGlobal(1);

if ($globalVar === null) {
    echo "Global variable is null\n";
} else {
    function f() {
        return get_class_methods(get_class($globalVar));
    }

    try {
        $methods = f();
        foreach ($methods as $method) {
            echo $method. "\n";
        }
    } catch (Exception $e) {
        echo "Caught exception: ". $e->getMessage(). "\n";
    }
}

?>
