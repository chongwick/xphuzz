<?php

// Symbol class is not available in PHP, so we cannot use Symbol.unscopables
// We will use an empty array instead

const v2 = [];

function v6() {
  try {
    $v11 = eval('return '. json_encode(v2). ';');
    $v12 = $v11;
  } catch(Exception $e) {
    // Handle the exception here
  }
}

for ($v17 = 1; $v17 < 10000; $v17++) {
  v6();
}

?>
