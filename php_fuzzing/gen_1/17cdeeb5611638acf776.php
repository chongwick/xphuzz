<?php
require "/home/w023dtc/template.inc";


function testFreezeAndUnserialize() {
  $sym ='sym';
  $sloppy = array($sym =>'sym');
  $sloppy = json_encode($sloppy);
  $sloppy = json_decode($sloppy, true);
  $desc = array();
  foreach ($sloppy as $k => $v) {
    $desc[$k] = $v;
  }
  $desc[$sym] = '12345';
  $sloppy = json_encode($desc);
  var_dump($sloppy);
  $sloppy = unserialize($sloppy);
  var_dump($sloppy);
  var_dump($sloppy[$sym]);
  $sloppy[$sym] = '67890';
  var_dump($sloppy);
  echo $sloppy[$sym]. "\n";
}

testFreezeAndUnserialize();

function testFreezeAndUnserializeWithBigNumbers() {
  $sym ='sym';
  $sloppy = array($sym => PHP_INT_MAX);
  $sloppy = json_encode($sloppy);
  $sloppy = json_decode($sloppy, true);
  $desc = array();
  foreach ($sloppy as $k => $v) {
    $desc[$k] = $v;
  }
  $desc[$sym] = PHP_INT_MIN;
  $sloppy = json_encode($desc);
  var_dump($sloppy);
  $sloppy = unserialize($sloppy);
  var_dump($sloppy);
  var_dump($sloppy[$sym]);
  $sloppy[$sym] = PHP_FLOAT_MAX;
  var_dump($sloppy);
  echo $sloppy[$sym]. "\n";
}

testFreezeAndUnserializeWithBigNumbers();

function testFreezeAndUnserializeWithBigFloats() {
  $sym ='sym';
  $sloppy = array($sym => PHP_FLOAT_MAX);
  $sloppy = json_encode($sloppy);
  $sloppy = json_decode($sloppy, true);
  $desc = array();
  foreach ($sloppy as $k => $v) {
    $desc[$k] = $v;
  }
  $desc[$sym] = PHP_FLOAT_MIN;
  $sloppy = json_encode($desc);
  var_dump($sloppy);
  $sloppy = unserialize($sloppy);
  var_dump($sloppy);
  var_dump($sloppy[$sym]);
  $sloppy[$sym] = PHP_INT_MAX;
  var_dump($sloppy);
  echo $sloppy[$sym]. "\n";
}

testFreezeAndUnserializeWithBigFloats();

?>
