<?php
require "/home/w023dtc/template.inc";

class Astronaut {
  public $name = PHP_INT_MAX;
  public $ship = PHP_INT_MIN;
  public $location = PHP_FLOAT_MAX;
  public $message = PHP_FLOAT_MIN;

  function __construct() {
    $this->ship->addAttribute(bin2hex("01101110". str_repeat(chr(33), 257). "10101010"), "Don't Panic!", str_repeat(chr(161), 5473817451));
    echo "Randomly generated attributes: ". $this->ship->asXML(). "\n";
    echo "Top-secret message: ". $this->message. "\n";
  }
}

$galacticCowboy = new Astronaut();
echo $galacticCowboy->name. "\n";
echo $galacticCowboy->location. "\n";
echo $galacticCowboy->ship. "\n";
echo $galacticCowboy->message. "\n";
?>
