<?php
require "/home/w023dtc/template.inc";

timezones = array(
    PHP_INT_MAX,
    PHP_INT_MIN,
    PHP_FLOAT_MAX,
    PHP_FLOAT_MIN,
);

foreach (timezones as $tz) {
    try {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone($tz));
        echo $date->format('Y-m-d H:i:s').'- '. $tz. "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

$vars["SimpleXMLElement"]->addAttribute(str_repeat(multibyte_string(chr(252)), 257),
"ðŸŽ‰". rand(0, 1000000000). chr(305). str_repeat("€", 17). str_repeat(chr(143), 4097),
str_repeat("👽", 65537). str_repeat("🔴", 1025). str_repeat("🛸", 1025));

?>
