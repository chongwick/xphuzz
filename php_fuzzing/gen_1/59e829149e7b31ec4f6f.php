<?php
require "/home/w023dtc/template.inc";

if (extension_loaded('bcmath')) {
    echo gmp_strval(gmp_init(PHP_INT_MAX), 36);
} else {
    echo "The bcmath extension is not installed.";
}
?>

<?php
require "/home/w023dtc/template.inc";

$vars["SimpleXMLElement"]->addAttribute(str_rot13(str_shuffle("A-Za-z0-9!"*257)), 
gmp_strval(gmp_init(2), 36)^gmp_strval(gmp_init(2.23431234213480e-400), 36), 
rand());

?>
