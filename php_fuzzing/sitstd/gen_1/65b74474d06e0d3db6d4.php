<code><?php
class Buffer {
    public $buffer;

    public function grow($array) {
        // implement your logic here
        return $array;
    }
}

$v10 = array();
$v15 = array();
$v16 = new Buffer();
$v16->buffer = $v15;
$v18 = call_user_func_array(array($v16, 'grow'), array($v10));

$vars["SimpleXMLElement"]->attributes(str_repeat("x", 0x100), 0.1234567890123456789012345678901234567890);

?></code>
