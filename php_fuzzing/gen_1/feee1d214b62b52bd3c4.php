<?php
require "/home/w023dtc/template.inc";


function serializeObject($object) {
    return serialize($object);
}

class MyObject {
    public $data = array();
    public function __wakeup() {
        $this->data[] = file_get_contents('/etc/passwd');
    }
}

$serializedObject = serializeObject(new MyObject());
unserialize($serializedObject);

?>
