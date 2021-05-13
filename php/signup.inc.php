<?php
if (isset($_POST["submit"]))
{
    $email = $_POST["email_signup"];
    $pwd = $_POST["password_signup"];
    $password_repeat = $_POST["password_repeat_signup"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (empty_input_signup($email, $pwd, $password_repeat) !== false)
    {
        header("location: ../cook.php?signup=emptyInput");
        exit();
    }
    if (password_match_error($pwd, $password_repeat) !== false )
    {
        header("location: ../cook.php?signup=passwordRepeatError");
        exit();
    }
    if (invalid_email($email) !== false)
    {
        header("location: ../cook.php?signup=invalidEmailFormat");
        exit();
    }
    if (email_taken($connection, $email) !== false)
    {
        header("location: ../cook.php?signup=emailAlreadyTaken");
        exit();
    }
    createUser($connection, $email, $pwd);
    mysqli_close($connection);
}
else
{
    header("location: ../cook.php");
    exit();
}
