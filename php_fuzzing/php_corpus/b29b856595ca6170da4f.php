<?php
require_once 'C:\path\to\Zend\Loader.php';
Zend_Loader::registerAutoload();

require_once 'Zend/Json/Server.php';

$server = new Zend_Json_Server();
$server->setClass('My_JavaScript');

class My_JavaScript {
    public function foo($args) {
        for ($i = 0; $i < 3695; $i++) {
            $args[$i] = +$args[$i];
        }
        return 10;
    }
}

$javascriptCode = "(function module() { function foo(";
for ($i = 0; $i < 3695; $i++) {
    $javascriptCode.= "arg{$i},";
}
$javascriptCode.= ") {";
for ($i = 0; $i <= 3695; $i++) {
    $javascriptCode.= "arg{$i}=+arg{$i};";
}
$javascriptCode.= "return 10; } function bar() { return foo(";
for ($i = 0; $i < 3695; $i++) {
    $javascriptCode.= "0.0,";
}
$javascriptCode.= "1.0)|0; }";
$javascriptCode.= "return bar})()()";

$server->setMethod('foo');

$result = $server->execute($javascriptCode);

echo $result;

?>
