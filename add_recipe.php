<?php
session_start();

    if((!isset($_SESSION["access_user"])) || ($_SESSION["access_user"] == 'user')) 
    {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'cook.php';
    header("Location: http://$host$uri/$extra");
    exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentCook | Add a recipe</title>
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
    <div id="blur_overlay" class="" onclick="closeForm()"></div>
    <div class="add-recipe">
        <div id="page">

            <div class="search-table">
                    <!-- logged in -->

                <a href='cook.php' id='logout'><i class='fas fa-arrow-left'></i></a>

                <input type="text" list="ingredients" class="input-search" placeholder="Add an ingredient" onfocus="this.value=''" id="ingredient">
                <div class="meals">
                    <table>
                        <ul class="ingredients" id="ingredients_section">
                        There are no ingredients
                        </ul>
                    </table>
                </div>
            </div>
<!-- Recipes section -->
            <div class="add_recipe_form">
            <form action="php/add_recipe.inc.php" method="post" class="form-recipe">
                    <label for="name_recipe"><b>Name recipe</b></label>
                    <input type="text" placeholder="Enter the name recipe" name="name_recipe" required>
                
                    <label for="ingredients_section_input"><b>Ingredients</b></label>
                    <input id='ingredients_section_input' type="text" placeholder="There are no ingredients" name="ingredients_section_input" readonly required>

                    <label for="link_recipe"><b>Link recipe</b></label>
                    <input type="text" placeholder="Enter the link recipe" name="link_recipe" required>

                    <label for="image_link_recipe"><b>Image link recipe</b></label>
                    <input type="text" placeholder="Enter the image link recipe" name="image_link_recipe" required>
                    <button type="submit" name="submit" class="btn">register the recipe</button>
            </form>
            </div>
        </div>
    </div>
    
</body>
</html>