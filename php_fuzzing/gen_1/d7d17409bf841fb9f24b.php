<?php
require "/home/w023dtc/template.inc";


class RecursiveObject extends \stdClass {
    public function __construct() {
        $this->a = new RecursiveObject();
    }
}

function recursiveCreateObject() {
    $obj = new RecursiveObject();
    $obj->b = new RecursiveObject();
    $obj->b->c = new RecursiveObject();
    //...
    // PHP_INT_MAX recursive calls
    //...
    return $obj;
}

$recursiveObject = recursiveCreateObject();

try {
    $recursiveObject->e->d->c->b->a;
} catch (\Exception $e) {
    echo "Exception thrown";
} catch (Throwable $t) {
    echo "No exception thrown";
}

?>
