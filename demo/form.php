<?php

// $name_array = ["Jane", "Smith", "Mark", "Gabriel", "Ivan", "Alex"];
// echo "Yess it works <br>";
// $username = $_POST['username'];
// $password = $_POST['password'];
// $minimun = 5;
// $maximum = 10;

// if(strlen($username) < $minimun) {
//     echo "Username has to be longer than 5 characters <br>";
// }
// if(strlen($username) > $maximum) {
//     echo "Username has to be shorter than 10 characters <br>";
// }
// if (!in_array($username, $name_array)){
//     echo "Sorry you are not allowed";
// }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form-process.php" method="post">
        <input type="text" placeholder="Enter username" name="username">
        <br>
        <input type="password" placeholder="Enter password" name="password">
        <br>
        <input type="submit" name="submit">

    </form>
</body>
</html>