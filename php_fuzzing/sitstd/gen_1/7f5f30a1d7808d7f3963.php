<?php
$m = array(
    'f' => function($x) use (&$m) {
        $x = (int)$x;
        $m['MEM'][$x] = 0;
    }
);
$heap = str_repeat("\0", 1024 * 32 * 8); // Assuming 8 bytes per Uint8Array element
$m['MEM'] = str_split($heap, 1);
$m['f'](-926416896 * 32 * 1024);

class PHPObject {
  private $data = [];

  public function __get($key) {
    return isset($this->data[$key])? $this->data[$key] : null;
  }

  public function __set($key, $value) {
    $this->data[$key] = $value;
  }
}

$o = new PHPObject();
$o->a = 7;

function spread($o) {
  $result = array_merge((array) $o, []);
  return $result;
}

for ($i = 0; $i < 3; $i++) {
  var_dump(spread([]));
  $o->a = 0;
  var_dump(spread((array) $o));
  var_dump(spread((array) "abc"));
}
?>
