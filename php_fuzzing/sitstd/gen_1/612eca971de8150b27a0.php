<?php

class Int64 {
    //... rest of the class definition...

    public function assignAdd($a, $b) {
        $carry = 0;
        for ($i = 0; $i < count($this->bytes); $i++) {
            $cur = $a[$i] + $b[$i] + $carry;
            $carry = $cur > 255? 1 : 0;
            $this->bytes[$i] = $cur & 0xFF;
        }
        return $this;
    }
}

$vars["SplFileObject"]->getCsvControl() * 0.5 * 2.23431234213480e-400 * sqrt(5473817451) * 123475932;


?>