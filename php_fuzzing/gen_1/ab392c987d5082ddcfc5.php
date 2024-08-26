<?php
require "/home/w023dtc/template.inc";


class Gerbil extends \DOMDocument {
    private $attributes;

    public function __construct($attributes) {
        $this->attributes = $attributes;
        "use asm";
    }

    public function addAttribute($name, $value) {
        $this->attributes[] = $value;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function __serialize() {
        return serialize($this->attributes);
    }
}

$vars["Gerbil"]->addAttribute(str_split("ᴴᵒᵉᵗᵃᵗʳᵃᵗʳ")[PHP_INT_MAX], str_split("ðŸ˜‚")[PHP_INT_MIN], str_split("I'm a secret code ")[PHP_FLOAT_MAX]);
echo unserialize($vars["Gerbil"]->serialize());

?>
