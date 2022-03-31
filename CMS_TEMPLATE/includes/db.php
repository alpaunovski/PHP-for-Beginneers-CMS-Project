<?php

//Cool way of using a FOREACH loop to define constsants
// $db["db_host"] = "localhost";
// $db["db_user"] = "root";
// $db["db_password"] = "";
// $db["database"] = "cms";

// foreach($db as $key => $value){
//     define(strtoupper($key), $value);
// }

//The default way of defining constants. VSCode complains if I use the FOREACH loop, says undefined constant.
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DATABASE", "cms");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DATABASE);

// if($connection){
//     echo "We are connected";
// }














?>