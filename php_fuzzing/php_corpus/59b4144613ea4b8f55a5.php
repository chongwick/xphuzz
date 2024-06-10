<?php

class MyObject {
    public function __set($name, $value) {
        $this->$name = $value;
    }
}

try {
    $obj = new MyObject();
    $obj->zero = '';
    assert('x');
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

try {
    $asyncIds = array();
    $triggerIds = array();
    class AsyncHooks {
        public function __invoke($asyncId, $type, $triggerAsyncId, $resource) {
            if ($type!== 'promise') {
                return;
            }
            array_push($asyncIds, $asyncId);
            array_push($triggerIds, $triggerAsyncId);
        }
    }
    $ah = new AsyncHooks();
    $ah->enable();
    $foo = function () {
        // your code here
    };
    $foo();
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

try {
    $obj = (object) array('prop' => 7);
    assert('nonexistant($obj)');
} catch (Exception $e) {
    echo "Caught: ". $e->getMessage();
}

?>
