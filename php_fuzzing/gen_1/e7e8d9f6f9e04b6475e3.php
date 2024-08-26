<?php
require "/home/w023dtc/template.inc";

echo PHP_INT_MAX.base64_encode(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_FLOAT_MAX), 17). str_repeat(chr(PHP_FLOAT_MIN), 4097));
