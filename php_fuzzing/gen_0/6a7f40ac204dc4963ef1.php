<?php
class MyDateTime extends DateTime
{
    public function __wakeup()
    {
        trigger_error('DateTime object is being unserialized', E_USER_ERROR);
    }
}
$dt = new MyDateTime('2001-01-01 00:00:00');
$serialized = serialize($dt);
unserialize($serialized);

?>