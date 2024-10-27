<?php
class Closure {
    public $delegate;
}
$closure = new Closure();
$closure->delegate = $closure;

?>