<?php

// Define a PHP class to mimic the JavaScript object
class __v_6 {
    public $first = 0;
    public $prop = 1;
}

// Create an instance of the class
$obj = new __v_6();

// Loop through the object's properties
foreach ($obj as $key => $value) {
    // Delete the property
    unset($obj->$key);
    // Call the gc function (Note: PHP does not have a built-in gc function like JavaScript)
    function v0() {
        $v7 = -4294967295;
        try {
            for ($v11 = 0; $v11 < 8; $v11++) {
                $v13 = 'Symbol.isConcatSpreadable';
                $v14 = $v11 && $v13;
                $v15 = $v7 <= $v14;
                for ($i = 0; $i < 10; $i++) {}
            }
        } catch (Exception $v20) {}
    }
    v0();
}

v0();
v0();
v0();

?>
