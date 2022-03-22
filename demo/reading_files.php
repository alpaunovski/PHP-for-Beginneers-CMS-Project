<?php

$file = "example.txt";

if($handle = fopen($file, "r")){

$content = fread($handle, filesize($file));

echo $content;

    fclose($handle);


} else {
    echo "The files could not be written";
}





















?>