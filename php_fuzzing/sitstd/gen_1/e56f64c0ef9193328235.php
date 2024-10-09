<?php
<code>
<?php
$a = array_fill(0, 65536, 0);

$vars["DateTimeImmutable"]->setTimezone(new DateTimeZone('Easter Island Time'));
$vars["DateTimeImmutable"]->modify('now + '. str_repeat('abc', 1000).'seconds');
$vars["DateTimeImmutable"]->setTimestamp(rand());

?>
</code>

?>