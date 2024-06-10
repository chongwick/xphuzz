<?php

function testAdvanceLastIndex($initial_last_index_value, $expected_final_last_index_value) {
    $exec_call_count = 0;
    $last_index_setter_call_count = 0;
    $final_last_index_value;

    class CustomRegexp {
        private $initial_last_index_value;

        public function __construct($initial_last_index_value) {
            $this->initial_last_index_value = $initial_last_index_value;
        }

        public function getGlobal() {
            return true;
        }

        public function getUnicode() {
            return true;
        }

        public function getLastIndex() {
            return $this->initial_last_index_value;
        }

        public function setLastIndex($v) {
            $last_index_setter_call_count++;
            $final_last_index_value = $v;
        }

        public function exec() {
            global $exec_call_count;
            $exec_call_count++;
            if ($exec_call_count == 1) {
                return array('');
            } else {
                return null;
            }
        }
    }

    $customRegexp = new CustomRegexp($initial_last_index_value);
    $regexp = new ReflectionMethod('CustomRegexp','exec');
    $regexp->invoke($customRegexp);

    $this->assertEquals(2, $exec_call_count);
    $this->assertEquals(2, $last_index_setter_call_count);
    $this->assertEquals($expected_final_last_index_value, $final_last_index_value);
}

testAdvanceLastIndex(-1, 1);
testAdvanceLastIndex(0, 1);
testAdvanceLastIndex(2**31 - 2, 2**31 - 1);
testAdvanceLastIndex(2**31 - 1, 2**31 - 0);
testAdvanceLastIndex(2**32 - 3, 2**32 - 2);
testAdvanceLastIndex(2**32 - 2, 2**32 - 1);
testAdvanceLastIndex(2**32 - 1, 2**32 - 0);
testAdvanceLastIndex(2**53 - 2, 2**53 - 1);
testAdvanceLastIndex(2**53 - 1, 2**
