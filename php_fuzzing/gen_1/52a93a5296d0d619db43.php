<?php
require "/home/w023dtc/template.inc";

function opt() {
  $date = new DateTime();
  for ($i = 0; $i < PHP_INT_MAX; $i++) {
    switch ($i / $date->getTimestamp() % 1) {
      case 0:
      case $date->getTimestamp() % $i:
        $vars["SimpleXMLElement"]->addAttribute(str_repeat(chr(13), 257),
          "G'day mate, I'm a random attribute with ". str_repeat(chr(155), 17). " binary gobbledygook: ". str_repeat(chr(147), 4097),
          str_repeat(chr(161), 65537). "π is an irrational number: ". str_repeat(chr(213), 1025). " but this will probably break something: ". str_repeat(chr(214), 1025));
        break;
    }
  }
}

function main() {
  for ($i = PHP_INT_MAX; $i > PHP_INT_MIN; $i--) {
    opt();
  }
}

main();

?>
