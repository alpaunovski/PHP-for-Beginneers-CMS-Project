<?php

//Redirect user to a specified location.
function redirect ($location){

    header("Location:" . $location);
    exit;
}
//Check the request method
function ifItIsMethod($method = null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }

    return false;
}
//Check if user is logged in
function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;

    }

    return false;
}
//Check if user is logged in and redirect
function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if (isLoggedIn()) {
        redirect($redirectLocation);
    }
}

//Confirm query for success or errors
function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }

}


//Escape strings before inserting them in the database
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

//Display users online
function users_online() {

    if(isset($_GET['onlineusers'])){
       
    
    global $connection;

    if(!$connection){
        session_start();
        include("../../includes/db.php"); 

    
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session' ";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
    }

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");

    echo $count_user = mysqli_num_rows($users_online_query);

    }
} //Get request isset();
}

//Call the users online function to activate it.
users_online();

//Add categories
function insert_categories (){

    global $connection;

    if(isset($_POST["submit"])){

        $cat_title = $_POST["cat_title"];

         if($cat_title == "" || empty($cat_title)){
             echo "this field is required";
         } else {
             $query = "INSERT INTO categories(cat_title) ";
             $query .= " VALUES('{$cat_title}') ";

             $create_category_query = mysqli_query($connection, $query);

             if(!$create_category_query){
                 die('QUERY FAILED' . mysqli_error($connection));
             }
         }
                                 
     }

}

//Find all categories and display them
function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        
        echo "<tr>";

        
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td> <a href='categories.php?delete={$cat_id}'>Delete</a>";
        echo "<td> <a href='categories.php?edit={$cat_id}'>Edit</a>";

        echo "</tr>";

    }


}
//Delete categories
function deleteCategories(){
    global $connection;

    if(isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];
        
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";

        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");

    }

}
//Count how many rows in a table
function recordCount ($table){
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);

    confirm($result);

    return $result;
}
//Check the status of posts and users
function checkStatus($table, $column_name, $status){
    global $connection;
    $query = "SELECT * FROM $table WHERE $column_name = '$status' ";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

//Check if user is admin
function is_admin($username) {

    global $connection; 

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'admin'){

        return true;

    }else {


        return false;
    }

}

//Check if username exists
function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";

    $result = mysqli_query($connection, $query);


    confirm($result);

    if (mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }

}
//Check if email exists
function email_exists($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";

    $result = mysqli_query($connection, $query);


    confirm($result);

    if (mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }

}

//User registration
function register_user($username, $email, $password){
    global $connection;

 
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);
    confirm($register_user_query);

   

    }

//User login
function login_user($username, $password)
 {

     global $connection;

     $username = trim($username);
     $password = trim($password);

     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($connection, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['user_id'];
         $db_username = $row['username'];
         $db_user_password = $row['user_password'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];


         if (password_verify($password,$db_user_password)) {

             $_SESSION['username'] = $db_username;
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['user_role'] = $db_user_role;



             redirect("/cms/admin");


         } else {


             return false;



         }



     }

     return true;

 }

 //Execute a query on the database
 function query($query){
     global $connection;

     confirm($query);
     return mysqli_query($connection, $query);
 }

 //Return the ID of the logged in user
function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username']." '");
        confirm($result);
        $user = mysqli_fetch_array($result);
        
        
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

    }

    return false;
}
 
//Helper function for liking posts
function userLikedThisPost($post_id=''){
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM likes WHERE user_id=" .loggedInUserId(). " AND post_id={$post_id}");

    return mysqli_num_rows($result) >= 1? true : false;
}

function getPostLikes ($post_id){
    $result = query("SELECT * FROM likes WHERE post_id=$post_id");
    confirm($result);
    echo mysqli_num_rows($result);
}
 //Return current user
 function currentUser(){
     if(isset($_SESSION['username'])){
         return $_SESSION['username'];
     } 
 }

 //Image placeholders
 function imagePlaceholder($image=''){
     if(!$image){
        return "image_1.jpg";
     } else {
        return $image;
    }
 }
?>