<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if($_POST['favorite']) {
    if(isset($_SESSION["email"]))
    {
        add_favorite($connection ,$_POST['favorite'], get_favorite($connection));
    }
    else
    echo "You are not logged in.";
}
function get_favorite($connection)
{
    $query = 'SELECT * FROM recipes WHERE id_db = $_SESSION["id"];';
    $result=mysqli_query($connection,$query); 
    echo $result;
}
function add_favorite($connection,$id, $favorites)
{
    echo $favorites;
    $ids = '';
    $ids .=  ' '.$id;
    $my_id = $_SESSION['id'];
    $sql = "UPDATE users SET favorite_recipe=$ids WHERE id_db=$my_id;";

    if (mysqli_query($connection, $sql) === TRUE) {
    echo "Record updated successfully";
    } else {
    echo "Error updating record: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
?>