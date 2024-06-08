<?php
// Public function field with computed name
$buggy = (function() {
    $obj = (new class {
        public function __invoke($x) {
            return 1337.0;
        }
    })();
    return $obj(1); // Call the __invoke method with an argument
})();

// Public method with computed name
$buggy = (function() {
    $obj = new class {
        public function __call($method, $args) {
            return "Public method $method called with arguments ". json_encode($args);
        }
    };
    return $obj;
})();

// Private function field with computed name
$buggy = (function() {
    $obj = (new class {
        public function __invoke($x) {
            return 1337.0;
        }
    })();
    return $obj(1); // Call the __invoke method with an argument
})();

// Private method with computed name
$buggy = (function() {
    $obj = new class {
        public function __call($method, $args) {
            return "Private method $method called with arguments ". json_encode($args);
        }
    };
    return $obj;
})();

?>

?>