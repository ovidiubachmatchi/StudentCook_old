<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What Could I Cook?</title>
    <link rel="stylesheet" href="css/cook.css">
    <script src="https://kit.fontawesome.com/619a94c9b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="javascript/cook_autocomplete_search.js"></script>
        <script src="javascript/cook.js"></script> 
</head>
<body>
    <div class="portrait">
        <p>Rotate your display</p>
    </div>
    <div id="blur_overlay" class="" onclick="closeForm()"></div>
    <div class="cook-page">
        <div id="page">
<!-- Log in form -->
            <div class="form-popup" id="login">
            <form action="php/login.inc.php" method="post" class="form-container">
                <p id="error_login" style='text-align: center'></p>
                    <label for="email_login"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email_login" required>
                
                    <label for="password_login"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password_login" required>

                    <b id="sign-up-message">Don't have an account yet? <a onclick="openSignUpForm()" id="sign-up-anchor">Sign Up</a></b>
                    <button type="submit" name="submit" class="btn">Log in</button>
            </form>
            </div>
<!-- Sign up form -->
            <div class="form-popup" id="signup">
                <form action="php/signup.inc.php" method="post" class="form-container">
                <p id="error_signup" style='text-align: center'></p>
                <label for="email_signup"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email_signup" required>
            
                <label for="password_signup"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password_signup" required>

                <label for="password_repeat_signup"><b>Repeat Password   </b><b id="confirm-password-message"></b></label>
                <input type="password" placeholder="Repeat Password" name="password_repeat_signup" required>
        
                <b id="sign-up-message">Already have an account? <a onclick="openForm()" id="sign-up-anchor">Log in</a></b>
                <button type="submit" name="submit" class="btn">Sign up</button>
                </form>
            </div>
<!-- Search ingredients section -->
            <div class="search-table">
                    <!-- logged in -->
                    <?php 
                        if(isset($_SESSION["email"]))
                            echo "<a href='php/logout.inc.php' id='logout'><i class='fas fa-sign-out-alt'></i></a>";
                        else
                            echo "<a onclick='openForm()'><i class='fas fa-user-circle'></i></a>";
                    ?>
                <input type="text" list="ingredients" class="input-search" placeholder="Add an ingredient" onfocus="this.value=''" id="ingredient">
                <div class="meals">
                <button onclick="showRecipes()" id="show_recipes">Show recipes</button>
                    <table>
                        <ul class="ingredients" id="ingredients_section">
                            There are no ingredients
                        </ul>
                    </table>
                </div>
            </div>
<!-- Recipes section -->
            <div class="recipes" id="recipes">

            </div>
        </div>
    </div>
    
</body>
</html>
<?php
    if (isset($_GET["signup"]))
    {
        if ($_GET["signup"] == "emptyInput")
            echo "<script>emptyinputSignup()</script>";
        if ($_GET["signup"] == "passwordTooShort")
            echo "<script>passwordTooShort()</script>";
        else if ($_GET["signup"] == "passwordRepeatError")
            echo "<script>passwordRepeatError()</script>";
        else if ($_GET["signup"] == "invalidEmailFormat")
            echo "<script>invalidEmailFormat()</script>";
        else if ($_GET["signup"] == "emailAlreadyTaken")
            echo "<script>emailAlreadyTaken()</script>";
        else if ($_GET["signup"] == "stmtFailed")
            echo "<script>stmtFailedSignup()</script>";
    }
    if (isset($_GET["signupSuccess"]))
        echo "<script>signupSuccess()</script>";
    
    if (isset($_GET["login"]))
    {
        echo '<script>openForm();</script>';
        if ($_GET["login"] == "emptyInput")
            echo "<script>emptyInputLogin()</script>";
        else if ($_GET["login"] == "wrongEmail")
            echo "<script>wrongEmail()</script>";
        else if ($_GET["login"] == "wrongPassword")
            echo "<script>wrongPassword()</script>";
        else if ($_GET["login"] == "stmtFailed")
            echo "<script>stmtFailedLogin()</script>";
    }
?>