<?php
if (isset($_POST["submit"]))
{
    $email = $_POST["email_login"];
    $password = $_POST["password_login"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (empty_input_login($email, $password) !== false)
    {
        header("location: ../cook.php?login=emptyInput");
        exit();
    }
    loginUser($connection, $email, $password);
    mysqli_close($connection);
}
else
{
    header("location: ../cook.php");
    exit();
}