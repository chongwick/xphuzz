<?php
$builder = new stdClass();
$builder->addImportedTable = function($x, $table, $initial, $maximum) {
    // No direct equivalent in PHP, but we can simulate it using an array
    $this->tables[$x] = array('initial' => $initial,'maximum' => $maximum);
};

$builder->addFunction = function($name, $signature) {
    $this->functions[$name] = array('signature' => $signature);
};

$builder->addBody = function($instructions) {
    // No direct equivalent in PHP, but we can simulate it using an array
    $this->bodies[$name] = $instructions;
};

$builder->exportAs = function($name) {
    // No direct equivalent in PHP, but we can simulate it using an array
    $this->exports[$name] = true;
};

$module = json_decode(json_encode($builder), true);

$table = array('element' => 'anyfunc', 'initial' => 1,'maximum' => 1000000);

$table['length'] = 0; // Initialize the length to 0

$instance = array('module' => $module, 'x' => array('table' => $table));

for ($i = 0; $i < 4; $i++) {
    $table['length'] += 99900;
}

$instance2 = array('module' => $module, 'x' => array('table' => $table));

$instance2['module']['exports'] = array(); // Initialize the exports array

$instance2['module']['exports']['main'] = function() {
    echo "Hello, World!";
};

function double2int($v) {
  $buf = pack('d', $v);
  $iarr = unpack('N*', $buf);
  return ($iarr[1] << 32) + $iarr[0];
}

try {
  // Create a double elements array.
  $iterable = array_fill(0, 10, 123.123);

  // Create a new SplMap object.
  $map = new \SplDoublyLinkedList();

  foreach ($iterable as $value) {
    $map->push($value);
  }
} catch (Exception $e) {
  echo $e->getMessage(). "\n";
  preg_match('/TypeError: Iterator value ([0-9\.e\-]+)/', $e->getMessage(), $match);
  $val = floatval($match[1]);
  echo "Memory Value: ". dechex(double2int($val)). "\n";
}

$instance2['module']['exports']['main'](0x313131 / 8);

?>
