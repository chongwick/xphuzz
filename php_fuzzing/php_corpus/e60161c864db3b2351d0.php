<?php

// Tests that insertion at the beginning via unshift won't crash when using a
// constructor that creates an array larger than normal. (Also values inserted
// by original constructor past the end should not survive into the result of
// unshift).
function testUnshift() {
  $a = array(1);
  $f = function() {
    return $a;
  };
  $b = call_user_func($f);
  array_unshift($b, 2);
  $this->assertEquals($b, array(2));
}

testUnshift();

// Tests that insertion past the end won't expose values previously put into the
// backing store by using a constructor that creates an array larger than normal.
function testInsertionPastEnd() {
  $a = array(9,9,9,9);
  $f = function() {
    return $a;
  };
  $b = call_user_func($f);
  $b[4] = 1;
  $this->assertEquals($b, array(1, 2, null, null, 1));
}

testInsertionPastEnd();

// Tests that using array with a constructor returning an object with an
// unwriteable length throws a TypeError.
function testFrozenArrayThrows() {
  $a = array(1, 2, 3);
  try {
    $b = array_merge(array(), $a);
  } catch (TypeError $e) {
    $this->assertTrue(true);
  }
}

testFrozenArrayThrows();

?>
