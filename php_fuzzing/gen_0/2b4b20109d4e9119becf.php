<?php
class X implements \Serializable
{
    private $a;

    public function __construct($a)
    {
        $this->a = $a;
    }

    public function serialize()
    {
        $this->a ='serialized';
        return serialize($this);
    }

    public function unserialize($serialized)
    {
        $this->a = 'unserialized';
        parent::unserialize($serialized);
    }
}

$object = new X('original');
$serialized = serialize($object);
$object = unserialize($serialized);

?>