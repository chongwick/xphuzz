<?php

class This {
    public function __get($name) {
        if ($name == 'x') {
            return function() { return 'Hello, World!'; };
        }
    }
}

$this_obj = new This();
$x = $this_obj->x;
echo $x(); // This will execute the Closure and return the string 'Hello, World!'

?>
