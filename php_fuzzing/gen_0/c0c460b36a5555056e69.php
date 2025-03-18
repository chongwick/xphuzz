<?php

function testSeal() {
  $sloppy = array();
  $sym ='sym';
  $sloppy[$sym] = 123;
  $sloppy = json_encode($sloppy);
  json_decode($sloppy, true);
  var_dump(json_decode($sloppy, true));
  $desc = json_decode($sloppy, true);
  var_dump($desc);
  echo $desc[$sym]. "\n";
  var_dump(json_encode($desc));
  echo json_encode($desc). "\n";
}

testSeal();

function testFreeze() {
  $sloppy = array();
  $sym ='sym';
  $sloppy[$sym] = 123;
  $sloppy = json_encode($sloppy);
  json_decode($sloppy, true);
  var_dump(json_decode($sloppy, true));
  $desc = json_decode($sloppy, true);
  var_dump($desc);
  echo $desc[$sym]. "\n";
  var_dump(json_encode($desc));
  echo json_encode($desc). "\n";
}

testFreeze();

function testIsFrozenAndIsSealed() {
  $sym ='sym';
  $obj = array($sym => 123);
  $obj = json_encode($obj);
  json_decode($obj, true);
  var_dump(json_decode($obj, true));
  echo json_encode(json_decode($obj, true)). "\n";
}

testIsFrozenAndIsSealed();

?>
