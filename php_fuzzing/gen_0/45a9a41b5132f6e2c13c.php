<?php

class A implements \Serializable
{
    private $data = 'A';

    public function serialize()
    {
        return serialize($this->data);
    }

    public function unserialize($serialized)
    {
        $this->data = unserialize($serialized);
    }
}

class B extends A
{
    private $data = 'B';

    public function serialize()
    {
        return serialize($this->data);
    }

    public function unserialize($serialized)
    {
        $this->data = unserialize($serialized);
    }
}

$a = new A();
$b = new B();

$b->unserialize($a->serialize());
