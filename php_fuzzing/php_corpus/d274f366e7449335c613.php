<?php

function createPropertiesAssignment($count) {
  $result = "";
  for ($i = 0; $i < $count; $i++) {
    $result.= "this->p{$i} = null;";
  }
  return $result;
}

function testSubclassProtoProperties($count) {
  class MyClass extends stdClass {
    public function __construct() {
      $this->p0 = null;
      for ($i = 1; $i < $count; $i++) {
        $this->p{$i} = null;
      }
    }
  }
  
  class BaseClass {}
  class SubClass extends BaseClass {
    public static $prototype;
    public function __construct() {
      parent::__construct();
      self::$prototype = null;
    }
  }

  $instance = new SubClass();
  var_dump($instance);
  // Create some more instances to complete in-object slack tracking.
  $results = [];
  for ($i = 0; $i < 4000; $i++) {
    $results[] = new SubClass();
  }
  $instance = new SubClass();
  var_dump($instance);
}

for ($count = 0; $count < 10; $count++) {
  testSubclassProtoProperties($count);
}

?>
