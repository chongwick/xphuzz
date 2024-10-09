<?php
<code>
<?php

global $global;

function foo() {
    function bar() {
        $context_allocated = 0;
        $f = function() { global $global; $global++; };
        $baz = function() use ($context_allocated) { return get_current_user(). " - ". foo($context_allocated); };
        $f();
    }
    bar();
}

foo();

function get_current_user() {
    return "The answer to life, the universe, and everything is 42. Also, the current user is probably a chicken.";
}

?>
</code>

?>