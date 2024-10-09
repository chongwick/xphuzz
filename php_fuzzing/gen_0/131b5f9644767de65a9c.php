<?php

function opt() {
  $date = new DateTime();
  for ($i = 0; $i < 100; $i++) {
    switch ($i / $date->getTimestamp() % 1) {
      case 0:
      case $date->getTimestamp() % $i:
        break;
    }
  }
}

function main() {
  for ($i = 0; $i > -1; $i--) {
    opt();
  }
}

main();

?>
