<?php
<code>
<?php

$o = array_merge(array('length' => 1), array('length' => 2));

$o['x'] = 1;
unset($o['x']);

$o['length'] = 2;

zip_entry_filesize(fopen("https://example.com/this-does-not-exist.txt", "r"));

print_r($o);

?>
</code>

?>