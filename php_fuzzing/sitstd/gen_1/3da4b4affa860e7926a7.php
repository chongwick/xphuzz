<?php
<code>
<?php

function assertThrows(callable $callback) {
    try {
        $callback();
        throw new Exception('Expected exception not thrown');
    } catch (TypeError $e) {
        // expected
    }
}

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = 64 * 1024 * 1024 / 0x10000;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    call_user_func_array(array('SplFixedArray','subarray'), array(array($array), function($x) use (&$array) {
        $array[0]->initial += 1;
        return $x;
    }));
});

class MyRegExp {
    function __construct($pattern, $flags = '') {
        $this->pattern = $pattern;
        $this->flags = $flags;
    }

    function exec($str) {
        $r = preg_match_all($this->pattern. $this->flags, $str, $matches);
        if ($r) {
            $matches = array();
        }
        return $matches;
    }
}

$result = preg_match_all('/./', 'a', $matches);
assertThrows(function() use ($matches) {
    $crash = $matches[0]['x']; // This will throw an error because $matches[0] is an array and does not have a property 'x'
});

?>
</code>

?>