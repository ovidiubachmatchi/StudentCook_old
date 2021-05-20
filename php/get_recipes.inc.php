<?php

function print_recipe_card($row, $procent_match, $inverse_procent, $it_uses) {
    echo ("
<div class='recipe' data-sort='$inverse_procent'>
    <a target='_BLANK' href='$row[3]'>
        <img src='$row[4]' >
        <div class=recipe-info>
        <div class='recipe-title'>
            $row[1]
        </div>
        </div>
        </img> 
        
        <a  onclick='favorite($row[0])' class='favorite-icon'> <i class='fas fa-heart'></i> </a>
        <p id='procent'>$procent_match% match</p>
    </a>
    <div class='bottom_part'>
    <p id='it_uses'>
    $it_uses
    </p> </div>
</div>
    ");
} 
function ingredients_match($recipe_ingredients, $my_ingredients, &$it_uses){
    $word = strtok($my_ingredients, ",");
    $matches = 0;
    while ($word !== false) {
    if (strstr($recipe_ingredients, $word)){
        $matches++;
        $it_uses .= $word . ', ';
    }
    $word = strtok(",");
    }
    return $matches;
}
function my_str_word_count($string) {
    if (strstr($string, ','))
    {
        $word = strtok($string, ",");
        $words = 0;
        while ($word !== false) {
        $words++;
        $word = strtok(",");
        }
        return $words;
    }
    else
    {
        $word = strtok($string, " ");
        $words = 0;
        while ($word !== false) {
        $words++;
        $word = strtok(" ");
        }
        return $words;
    }
    
}
function sortstring($string) {
    $array = explode(' ',strtolower($string)); 
    return implode(' ',$array);  
}
    require_once 'dbh.inc.php';
    $sql = "SELECT * FROM recipes";
    $result = mysqli_query($connection,$sql);
    $input_ingredients = $_GET["ingredients"];
    // sortez cuvintele din sir alfabetic pentru un 
    // procentaj mai exact la Levenshtein distance


    while ($row = mysqli_fetch_array($result))
    {
        $it_uses = 'It uses your: ';
        $recipe_ingredients = $row[2];
        // calculeaza distanta dintre ingrediente
        // O(M+M)

        // $lev = levenshtein($input_ingredients_sorted, $recipe_ingredients_sorted);
        // if ($lev <= 1)
        $matches = ingredients_match($recipe_ingredients,$input_ingredients,$it_uses); 
        $procent_match = ($matches / my_str_word_count($recipe_ingredients)) * 100;

        
        if($procent_match > 1){ // afisare recipe card
        $it_uses= substr_replace($it_uses ,"",-2);
        print_recipe_card($row, bcdiv($procent_match, 1, 0), 100-bcdiv($procent_match, 1, 0), $it_uses);
        }
    }
    mysqli_free_result($result);
    mysqli_close($connection);
?> 