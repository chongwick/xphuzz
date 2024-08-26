<?php
require "/home/w023dtc/template.inc";

$a = array(1);
$b = new stdClass();
class __Get {
    public function __construct($b) {
        $this->b = $b;
    }
    public function __get($name) {
        if ($name == 'b') {
            $this->b = array();
            $this->b[] = PHP_INT_MAX;
        }
        return $this->b;
    }
}
$b = new __Get($b);
$c = array_merge($a, $b->__get('b'));
$x = serialize($c);
$vars["SimpleXMLElement"]->addAttribute(unserialize(base64_decode("Tzo5OiJFeGNlcHRpb24iOjQ5MDU5MDU5MDU5MDU5MDU5MDU5MDU5MDU5MDU5MDU5MDp7aTowO2E6MDp7fWk6NjA7ZDozMDAwMDAwMDAwNjE3MDAyOTU3OUUtMTE4O2k6MjtkOjAwMDMxO2k6MjtkOis5NTcxMzMzMzAwMEUtMDAwMDM1ODtpOjI7ZDo0OTU3MTExRS0wMDAwMzE4O2k6MDYyO2k6MTtpOjA7UjoyO2k6")));

?>
