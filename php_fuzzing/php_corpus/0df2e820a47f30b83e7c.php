<?php

$workerScript = '
  function onMessage($sab) {
    $ta = unpack("C*", $sab);
    $tmp;
    while (true) {
      $index = mt_rand(0, count($ta) - 1);
      $value = mt_rand(1, 256);
      //print($index. " ". $value);
      $tmp = $ta[$index];
      $ta[$index] = $value;
      for ($i = 0; $i < $value; $i++);
      $ta[$index] = $tmp;
    }
  }
';

// 000054: 41 ff 0f                   | i32.const 2047
// 000057: 6a

$b = file_get_contents("./stack.wasm");
$ta = unpack("C*", $b);
$sb = str_split($b);
$sta = array_map("ord", $sb);
for ($i = 0; $i < count($ta); $i++) {
    $sta[$i] = $ta[$i];
}

// Transfer SharedArrayBuffer
//w.postMessage($sb);

// Run the worker function in the background
exec("php -f worker.php");

while (true) {
  try {
    $result = validateWebAssembly($sta);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

function validateWebAssembly($sta) {
  // implement your logic here
  // for demonstration purposes, return a random value
  return mt_rand(0, 100);
}

?>

