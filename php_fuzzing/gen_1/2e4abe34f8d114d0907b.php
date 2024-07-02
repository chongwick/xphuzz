<?php
<code>
<?php
class Get {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get,...$args) {
            // $args is an array of arguments
            // you can access them like this: $args[0], $args[1],...
            $splPriorityQueue = new \SplPriorityQueue();
            $splPriorityQueue->push($get, $args);
            return $splPriorityQueue->top()->explode("")->sort()->shuffle()->implode("")->rand();
        };
    }
}

class Get1 {
    public function __construct() {
        $this->__proto__ = new stdClass();
        $this->__proto__->get = function($get,...$args) {
            // $args is an array of arguments
            // you can access them like this: $args[0], $args[1],...
            $splPriorityQueue = new \SplPriorityQueue();
            $splPriorityQueue->push($get, $args);
            return $splPriorityQueue->top()->explode("")->sort()->shuffle()->implode("")->rand();
        };
    }
}

?>
</code>

?>