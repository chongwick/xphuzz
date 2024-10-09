<?php

$a = array(0, 1);
$o = (object) array(
    'valueOf' => function() {
        $GLOBALS['a'] = array(0 => 1);
        return 2;
    }
);

function __f_19350() {
  function __f_19351() {
    function __f_19352() {
    }
  }
  try {
    $o->valueOf();
    __f_19351();
  } catch (Exception $e) {}
}

$a[] = 2;
echo array_search(5, $a, false);
__f_19350();

?>
