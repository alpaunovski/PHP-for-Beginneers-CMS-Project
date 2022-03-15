<?php

if(isset($_POST['submit'])) {
    $name_array = ["Jane", "Smith", "Mark", "Gabriel", "Ivan", "Alex"];
    echo "Yess it works <br>";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $minimun = 5;
    $maximum = 10;

    if(strlen($username) < $minimun) {
        echo "Username has to be longer than 5 characters <br>";
    }
    if(strlen($username) > $maximum) {
        echo "Username has to be shorter than 10 characters <br>";
    }
    if (!in_array($username, $name_array)){
        echo "Sorry you are not allowed";
    } else {
        echo "Welcome";
    }
}









?>