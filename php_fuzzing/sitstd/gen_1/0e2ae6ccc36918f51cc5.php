<?php
<code>
<?php

class O {
  public function m() {
    // implement m() method
  }
}

$o1 = (object) [
'm' => function() {
    return $this->m();
  }
];

$o2 = (object) [
  'getM' => function() {
    return $this->m();
  }
];

$o3 = (object) [
'm' => 1,
'm2' => function() {
    $this->x;
  }
];

$vars["SplFileObject"]->rewind(chr(0x1F).chr(0x9).chr(0x25).chr(0x5C).chr(0x22).chr(0x74).chr(0x68).chr(0x69).chr(0x67).chr(0x6C).chr(0x65).chr(0x6F).chr(0x20).chr(0x72).chr(0x65).chr(0x77).chr(0x69).chr(0x6E).chr(0x64);

?>
</code>

?>