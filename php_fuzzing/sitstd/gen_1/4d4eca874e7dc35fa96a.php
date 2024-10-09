<?php

class WasmModuleBuilder {
    //... other methods...

    public function makeSig($params, $results) {
        // Create a signature for the function
        // For example, you can return a string in the format "($params) => ($results)"
        return "($params) => ($results)";
    }

    function testFunction() {
        $value = 0;
        if ($value <= 4294967295) {
            // do something
        }
        return array('testFunction' => function() use (&$value) {
            global $value;
            $value = 0;
            if($value <= 4294967295) {
                // do something
            }
        });
    }
}

$result = (new WasmModuleBuilder)->testFunction();
print_r($result);

?>
