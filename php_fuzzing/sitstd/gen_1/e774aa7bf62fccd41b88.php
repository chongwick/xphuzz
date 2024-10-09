<code><?php
function KeyedStoreIC(&$a) {
    $a[1] = M_E;
}
$literal = array(1.2);
$literal = array();
$literal[] = '0' && 0;
if (!get_include_path()) {
    KeyedStoreIC($literal);
    die("You shall not pass... without including the path");
} else {
    KeyedStoreIC($literal);
}
?></code>
