<?php

function getRandomProperty($v, $rand) {
    $properties = array_keys($v);
    $proto = get_class_methods(get_parent_class($v));
    if ($proto) {
        // Do nothing
    }
    if (isset($v->constructor) && method_exists($v->constructor, 'hasOwnProperty')) {
        // Do nothing
    }
    if (count($properties) == 0) {
        return "0";
    }
    return $properties[$rand % count($properties)];
}

$v2 = array(
    'FAST_ELEMENTS' => function() {
        return array(
            0 => function() {
            }
        );
    },
    'Arguments' => array(
        'FAST_SLOPPY_ARGUMENTS_ELEMENTS' => function() {
            $args = func_get_args();
            $v11 = call_user_func_array('array_merge', $args);
            $rand = mt_rand();
            $v11['randomProperty'] = $v11[getRandomProperty($v11, $rand)];
            $v11['__defineGetter__'] = 'randomGetter';
            function randomGetter() {
                gc();
                $v4[1486458228] = $v2[1286067691];
                return $v11['randomProperty'];
            }
            // array_key_exists('includes', get_class_methods('Array')) && call_user_func_array(array('Array', 'includes'), array($v11));
        },
        'Detached_Float64Array' => function() {
        }
    )
);

function f3($suites) {
    array_walk($suites, function($suite) {
        array_walk($suite, function($test) {
            $test();
        });
    });
}

f3($v2);

?>
