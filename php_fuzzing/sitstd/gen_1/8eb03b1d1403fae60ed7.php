<?php
<code>
<?php

class Key {
  public function __toString() {
    return 'Symbol';
  }
}

if (extension_loaded('bcmath')) {
    echo "The bcmath extension is installed. <br>";
} else {
    echo "The bcmath extension is not installed. <br>";
}

$obj = new stdClass();
$obj->{new Key()};

?>
</code>

?>