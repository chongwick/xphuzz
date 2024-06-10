<?php

require_once __DIR__. '/vendor/autoload.php';

function v1() {
    $v4 = 'Reflect';
    $v8 = array(11.11);
    $v10 = array('a' => -1, 'c' => 'RegExp', 'f' => $v8, 'd' => 1111, 'e' => -1);
    $v12 = array(11.11);
    function v13() {}
    $v16 = array('a' => v13, 'b' => v13, 'c' => v13, 'd' => v13, 'e' => v13, 'f' => v13, 'g' => v13, 'h' => v13, 'i' => v13, 'j' => v13);
}

function foo() {
    $v22 = 'Number';
    $v22 = 'v1';
    $v23 = false;
    if ($v23) {
        $v22 = 'Number';
    } else {
        function v24() {
            $v28 = '.Cactus'[0];
            for ($v32 = 0; $v32 < 7; $v32++) {}
        }
        $promise = new React\Promise\Promise(function ($resolve, $reject) {
            $v24();
            $resolve();
        });
        try {
            $v36 = array('cactus', 'cactus');
            foreach ($v36 as $v58) {
                $v117 = 'cactus';
            }
        } catch (Exception $e) {
            // Handle the exception
        }
    }
    $v22();
}

for ($i = 0; $i < 10; $i++) {
    foo();
}

?>
