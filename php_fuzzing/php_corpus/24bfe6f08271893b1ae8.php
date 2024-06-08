<?php

class Regex {
  private $pattern;
  private $subject;
  private $lastIndex;

  public function __construct($pattern, $subject) {
    $this->pattern = $pattern;
    $this->subject = $subject;
    $this->lastIndex = 0;
  }

  public function lastIndex() {
    return $this->lastIndex;
  }

  public function setLastIndex($index) {
    $this->lastIndex = $index;
  }

  // Implement the necessary methods for your regular expression functionality
}

class Derived extends Regex {
  function __construct() {
    // Syntax Error
    $a = 1;
  }

  public function lastIndex() {
    return parent::lastIndex();
  }

  public function setLastIndex($index) {
    parent::setLastIndex($index);
  }
}

$o = new \ReflectionClass('Derived');
$o = $o->newInstanceArgs([]);
var_dump($o);
// Check that we can properly access lastIndex.
assert($o->lastIndex == 0);
$o->setLastIndex(1);
assert($o->lastIndex == 1);
$o->setLastIndex(0);
gc_collect_cycles();

?>
