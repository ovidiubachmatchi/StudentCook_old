<?php

function empty_input_signup($email, $password, $password_repeat)
{
    if(empty($email))
        return true;
    if (empty($password))
        return true;
    if (empty($password_repeat))
        return true;
    return false;
}
function loginUser($connection, $email, $password)
{
    $emailExists = email_taken($connection, $email);
    if ($emailExists === false) 
    {
        header("location: ../cook.php?login=wrongEmail");
        exit();
    }
    $dbPassword = $emailExists["password_db"];
    if ( password_verify($password,$dbPassword) )
    {
        session_start();
        $_SESSION["id"] = $emailExists["id_db"];
        $_SESSION["email"] = $emailExists["email_db"];
        $_SESSION["access_user"] = $emailExists["access_user"];
        header("location: ../cook.php?loginSuccess");
        exit();
    }
    else
    {
        header("location: ../cook.php?login=wrongPassword");
        exit();
    }
}
function empty_input_login($email, $pwd)
{
    $result;
    if(empty($email) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function invalid_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    return true;
    return false;
}
function email_taken($connection, $email)
{
    $sql = "SELECT * FROM users WHERE email_db = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location: ../cook.php?login=stmtFailed");
    exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else {
        return false;
    }
    mysqli_stmt_close($stmt);
}
function password_match_error($pwd, $password_repeat)
{
    if($pwd === $password_repeat)
        return false;
    return true;
}
function addRecipe($connection, $name_recipe, $ingredients_recipe_input, $link_recipe, $image_link_recipe){
    $sql = "INSERT INTO recipes (name_recipe, ingredients_recipe, link_recipe, image_link_recipe) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
    header("location: ../add_recipe.php?error=stmtFailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss",  $name_recipe, $ingredients_recipe_input, $link_recipe, $image_link_recipe);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../add_recipe.php?success");
    exit();
}
function createUser($connection, $email, $password)
{
    $sql = "INSERT INTO users (email_db, password_db) VALUES (?,?);";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
    header("location: ../cook.php?signup=stmtFailed");
    exit();
    }
    if (strlen($password) < 6)
    {
    header("location: ../cook.php?signup=passwordTooShort");
    exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    loginUser($connection, $email, $password);
    header("location: ../cook.php?signupSuccess");
    exit();
}