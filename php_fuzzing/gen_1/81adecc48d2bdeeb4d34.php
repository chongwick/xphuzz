<?php
require "/home/w023dtc/template.inc";


class __c_0 {
  public function __construct() {
    $this->x = serialize(array_fill(0, PHP_INT_MAX, 0));
    for ($i = 0; $i < 10; $i++) {
      $this->x;
    }
  }
}

for ($i = 0; $i < PHP_INT_MAX; $i++) {
  new __c_0();
}

$vars["SimpleXMLElement"]->addAttribute(str_rot13(strtr("Bzngryvn Zrffntr", "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" => chr(ord("a") + rand(0, 25)).chr(ord("A") + rand(0, 25))), chr(0x20) + rand(0, 15)), str_replace(chr(0x20), str_repeat(chr(0x0D), 17), implode("", array_map("ord", str_split(strtr(base64_encode($vars["rand"]), "+/", "._"), 3)))) + str_repeat(chr(0x09), 4097), implode("", array_map("chr", array_map("rand", array_fill(0, 65537, 0), array_fill(0, 1025, 32)))) + str_repeat(chr(0x1F), 1025) + str_repeat(chr(0x13), 1025));

?>
