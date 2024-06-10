<?php

$ARROW_ARG = '/([^\(]+?)=>/';

$fn = function($bar) {
    $fn_str = 'function('. $bar. ') { '. $bar. '; }';
    eval($fn_str);
};

$args = preg_match($ARROW_ARG, 'function(foo =>)', $match);
// returns 1 in PHP 7.2

$fn('foo =>');

?>
