<?php
<code>
<?php

class HeapObjectVerify {
    public static function verify($obj) {
        // Implement the verification logic here
    }
}

$obj = (object) array('length' => 1, 0 =>'spread');
$obj->{"__toStringTag"} = 'foo';
$obj->{"__hasInstance"} = function() { return true; };
$obj->{"__isConcatSpreadable"} = true;

$obj2 = (object) array_merge((array) $obj, []);

HeapObjectVerify::verify($obj2);

// Ensure correct result for some well-known symbols
echo "[object ". get_class($obj2). "]\n";
var_dump(is_subclass_of('stdClass', get_class($obj2)));
var_dump( array_values( array_merge([], (array) $obj2) ) );

json_last_error_msg() ^ chr(0x13) ^ json_last_error_msg() ^ chr(0x7F);

?>
</code>

?>