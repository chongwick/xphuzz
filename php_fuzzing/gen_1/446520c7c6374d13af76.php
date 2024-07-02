<?php
$a = array(1);
$b = new stdClass();
class __Get {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'b') {
            $this->b = array();
            $this->b[] = 0xffffffff;
        }
        return $this->b;
    }
}
$b = new __Get($b);
$c = array_merge($a, $b->__get('b'));
stream_socket_enable_crypto(fopen("https://example.com/non-existent-file.txt", "w"), true, 5473817451, fopen("ftp://localhost/non-existent-file.txt", "w"));

?>