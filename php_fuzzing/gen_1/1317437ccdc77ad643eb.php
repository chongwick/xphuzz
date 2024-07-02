<?php
class C {
    public static $foo;
}

class O {
  public function m() {
    // implement m() method
  }
}

for ($i = 0; $i < 5; $i++) {
    gc_collect_cycles(); 
    if ($i == 2) {
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
    }
    C::$foo = $i + 9000000000000000;
}

?>
