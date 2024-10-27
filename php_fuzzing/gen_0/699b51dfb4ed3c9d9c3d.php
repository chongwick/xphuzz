<?php
class Test {
    public $prop = array();
}
$test = new Test();
$test->prop[] = serialize(new ReflectionClass('Test'));
unserialize($test->prop[0]);
