<?php
require "/home/w023dtc/template.inc";


class Int64 {
    //... rest of the class definition...

    public function assignAdd($a, $b) {
        $carry = 0;
        for ($i = 0; $i < count($this->bytes); $i++) {
            $cur = PHP_INT_MAX + PHP_INT_MIN + $a[$i] + $b[$i] + $carry;
            $carry = $cur > 0x7FFFFFFFFFFFFFFF? 1 : 0;
            $this->bytes[$i] = $cur & 0xFF;
        }
        return $this;
    }
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(microtime(), 257),
        (strlen('a') * 42) ^ str_word_count('hello world') + str_repeat('!', 17) + str_repeat(chr(145), 4097),
        str_repeat('π', 65537) + str_repeat('e', 1025) + str_repeat('π', 1025));

?>
