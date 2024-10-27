<?php
class Crash {
    public function __toString() {
        while (true) {
            get_class_methods('NonExistentClass');
        }
    }
}

(new Crash)->__toString();

?>