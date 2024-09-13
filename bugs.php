<?php
date_default_timezone_set("Europe/London");
class Foo {
    public static function test() {
        static $i = 0;
        var_dump(++$i);
    }
}

eval("class Bar extends Foo {}"); // Avoid early binding.

Foo::test();
date(DATE_ATOM."\n".DATE_RFC2822."\nc\nr\no\ny\nY\nU\n\n", PHP_INT_MIN);

Bar::test();

echo date(DATE_ATOM."\n".DATE_RFC2822."\nc\nr\no\ny\nY\nU\n\n", PHP_INT_MAX);

?>

#home/dan/php-8.1.29/ext/date/lib/unixtime2tm.c:142:4: runtime error: signed integer overflow: 9223372036854775807 + 32400 cannot be represented in type 'long long int' for 
#date_default_timezone_set("Asia/Tokyo");
#echo date(DATE_RFC2822, PHP_INT_MAX);

#/home/dan/php-8.1.29/ext/date/lib/parse_posix.c:493:22: runtime error: signed integer overflow: 106751991167328 * 86400 cannot be represented in type 'long long int' for
#date_default_timezone_set("America/Los_Angeles");
#echo date(DATE_RFC2822, PHP_INT_MAX);

#php-8.1.29/ext/standard/mt_rand.c:280:24: runtime error: signed integer overflow: 9223372036854775807 - -9223372036854775808 cannot be represented in type 'long int' for
#echo rand(PHP_INT_MIN,PHP_INT_MAX);

#
#$doc = new DOMDocument();
$impl = $doc->implementation;
$doctype = $impl->createDocumentType('mydoctype');
$doc->appendChild($doctype);
