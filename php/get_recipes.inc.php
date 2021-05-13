<?php

function print_recipe_card($row, $procent_match) {
    echo ("
    <div class='recipe'>
    <a target='_BLANK' href='$row[3]'>
        <img src='$row[4]' >
        <div class='recipe-info'>
            <div class='recipe-title'>
                $row[1]
            </div>
        </div>
        <a class='favorite-icon' id='id-$row[0]'> <i class='fas fa-heart'></i> </a>
        <p id='procent'>$procent_match% match</p>
    </a>
    </div>
    ");
}
function ingredients_match($recipe_ingredients, $my_ingredients){
    $word = strtok($my_ingredients, " ");
    $matches = 0;
    while ($word !== false) {
    if (strstr($recipe_ingredients, $word))
        $matches++;
    $word = strtok(" ");
    }
    return $matches;
}
function sortstring($string) {
    $array = explode(' ',strtolower($string)); 
    sort($array);
    return implode(' ',$array);  
  }
    require_once 'dbh.inc.php';
    $sql = "SELECT * FROM recipes";
    $result = mysqli_query($connection,$sql);
    $input_ingredients = $_GET["ingredients"];
    // sortez cuvintele din sir alfabetic pentru un 
    // procentaj mai exact la Levenshtein distance
    $input_ingredients_sorted = sortstring($input_ingredients);

    while ($row = mysqli_fetch_array($result))
    {
        $recipe_ingredients_sorted = sortstring($row[2]);
        // calculeaza distanta dintre ingrediente
        // O(M+M)

        // $lev = levenshtein($input_ingredients_sorted, $recipe_ingredients_sorted);
        // if ($lev <= 1)
        $matches = ingredients_match($recipe_ingredients_sorted,$input_ingredients_sorted); 
        $procent_match = ($matches / str_word_count($recipe_ingredients_sorted, 0)) * 100;
        // afisare recipe card
        if($procent_match > 1)
        print_recipe_card($row, bcdiv($procent_match, 1, 0));
    }
    mysqli_free_result($result);
    mysqli_close($connection);
?> 