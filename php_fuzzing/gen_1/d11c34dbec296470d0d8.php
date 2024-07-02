<?php

class This {
    public function __get($name) {
        if ($name == 'x') {
            return function() { return 'Hello, World!'; };
        }
    }
}

$vars = array("a" => 1, "b" => "2", "c" => 3.0, "d" => null, "e" => new stdClass());
$vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
bin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)),
bin2hex(str_repeat(chr(161), 65537). str_repeat(chr(213), 1025). str_repeat(chr(214), 1025)));

$this_obj = new This();
$x = $this_obj->x;
echo $x(); // This will execute the Closure and return the string 'Hello, World!'

openssl_seal(implode(array_map(function($c) {return "\\x". str_pad(dechex($c), 2, "0");}, range(0, 255))), "a string", array("a" => "a", "b" => "b", "c" => "c"), $vars, str_repeat("A", 0x100), "another string");

?>
