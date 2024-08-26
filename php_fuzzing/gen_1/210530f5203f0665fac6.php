<?php
require "/home/w023dtc/template.inc";


$cnt = 0;
$reg = '/./';
$reg_callback = function () use (&$cnt) {
  global $cnt;
  if ($cnt++ == 0) {
    return json_encode((object) array('get' => function() { global $array; array_pop($array); return 'funky'; }));
  }
  $cnt = 0;
  return null;
};

assertThrows(function () {
  preg_replace($reg, $reg_callback, '');
}, RangeError::class);

?>
