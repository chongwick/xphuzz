<?php
require "/home/w023dtc/template.inc";


assert_options(ASSERT_ACTIVE);

function anyfunc() {
    return PHP_INT_MAX;
}

$table = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $table[] = anyfunc();
}

function assertThrows($callback, $expectedException) {
    try {
        $callback();
    } catch (Exception $e) {
        if ($e instanceof $expectedException) {
            return true;
        } else {
            throw $e;
        }
    }
    throw new UnexpectedValueException("Expected exception of type ". get_class($expectedException). " but got ". get_class($e));
}

try {
    $table[PHP_INT_MAX];
} catch (RangeError $e) {
    echo "Caught RangeError as expected!";
} catch (Exception $e) {
    echo "Did not catch RangeError as expected!";
}

?>
