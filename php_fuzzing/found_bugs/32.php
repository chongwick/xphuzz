<?php
class __Get {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'pattern') {
            $this->b ='|(?P<name>)(\d+)|';
        } elseif ($name =='match') {
            $this->b = array();
            $this->b[] = 0xffffffff;
        }
        return $this->b;
    }
}

$b = new __Get('');
$pattern = $b->__get('pattern');
preg_match($pattern, $b->__get('match')[0], $m);
var_dump($m);
?>
