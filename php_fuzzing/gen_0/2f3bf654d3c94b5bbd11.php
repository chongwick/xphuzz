<?php
$xml = '';
for ($i = 0; $i <= PHP_INT_MAX; $i++) {
    $xml.= '<a>'. xml_get_current_line_number(). '</a>';
}
xml_parse_into_struct($xml);

?>