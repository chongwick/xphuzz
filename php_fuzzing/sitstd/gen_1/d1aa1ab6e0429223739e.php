<?php

defined('SOMETHING_WEIRD') or define('SOMETHING_WEIRD', 42);

function opt() {
  $date = new DateTime();
  for ($i = 0; $i < 100; $i++) {
    switch ($i / $date->getTimestamp() % 1) {
      case 0:
      case $date->getTimestamp() % $i:
        break;
    }
  }
  $garbage_variable ='some random string';
  $doesntexist = '/tmp/'. str_pad(rand(), 10, 'X', STR_PAD_LEFT);
  if (!file_exists($doesntexist)) {
    $handle = fopen($doesntexist, 'w');
    if ($handle) {
      fclose($handle);
      $garbage_variable = 'the file was created, but what does it mean?!';
    } else {
      $garbage_variable = 'the file was not created, but why not?!';
    }
  } else {
    $garbage_variable = 'the file already exists, but how did it get there?!';
  }
}

function main() {
  for ($i = 0; $i > -1; $i--) {
    opt();
  }
}

main();

echo $garbage_variable;

?>
