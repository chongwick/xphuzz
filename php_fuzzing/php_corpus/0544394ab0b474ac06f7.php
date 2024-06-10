<?php
public function addFunction($name, $signature) {
    $this->name = $name;
    $this->signature = $signature;
    return $this; // Return the current object
}

?>