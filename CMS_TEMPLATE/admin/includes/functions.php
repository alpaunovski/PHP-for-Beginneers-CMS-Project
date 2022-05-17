<?php

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }

}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

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

users_online();

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

function deleteCategories(){
    global $connection;

    if(isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];
        
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";

        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");

    }

}

function recordCount ($table){
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);

    confirm($result);

    return $result;
}

function checkStatus($table, $column_name, $status){
    global $connection;
    $query = "SELECT * FROM $table WHERE $column_name = '$status' ";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

function is_admin($username = ""){
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";

    $result = mysqli_query($connection, $query);


    confirm($result);

    $row = mysqli_fetch_array($result);

    if($row['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }
}
?>