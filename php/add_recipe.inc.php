<?php
if (isset($_POST["submit"]))
{
    $name_recipe = $_POST["name_recipe"];
    $link_recipe = $_POST["link_recipe"];
    $image_link_recipe = $_POST["image_link_recipe"];
    $ingredients_recipe_input = $_POST["ingredients_section_input"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    addRecipe($connection, $name_recipe, $ingredients_recipe_input, $link_recipe, $image_link_recipe);
    mysqli_close($connection);
}
else
{
    header("location: ../cook.php");
    exit();
}
