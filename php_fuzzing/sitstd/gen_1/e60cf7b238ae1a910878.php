<?php
$number = 5.0260805378947765e+223;
$nf = number_format($number, 0, '.', '');
echo $nf. " ". ($vars["ReflectionClassConstant"]->isPublic() * 0.5 + sin(3.14) * 2.71);
?>
