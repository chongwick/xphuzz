<?php
if(is_uploaded_file(PHP_INT_MAX))
{
    echo "File uploaded";
}
else
{
    echo "File not uploaded";
}

?>