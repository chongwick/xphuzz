<?php
if (extension_loaded('bcmath')) {
    xmlwriter_start_dtd_attlist(fopen("random_string.txt", "w+"), str_repeat(chr(0), 100000). chr(0x47). str_repeat(chr(0x5C), 257). chr(0x2F). str_repeat(chr(0x20), 4097). chr(0x3B));
    echo "The bcmath extension is installed.";
} else {
    xmlwriter_start_dtd_attlist(fopen("random_string.txt", "w+"), str_repeat(chr(0), 100000). chr(0x47). str_repeat(chr(0x5C), 257). chr(0x2F). str_repeat(chr(0x20), 4097). chr(0x3B));
    echo "The bcmath extension is not installed.";
}
?>
