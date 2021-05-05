var ingredients_list = new Set()

function put_ingredient(ingredient){
    if (!(ingredient == ""))
    if(ingredients_list.has(ingredient))
    ingredients_list.delete(ingredient)
    else
    ingredients_list.add(ingredient)
    show_ingredients()
}
function show_ingredients(){
     if (ingredients_list.size == 0)
     document.getElementById("demo").innerHTML = "There are no ingredients"
     else
     {
        var val = ""
        for (item of ingredients_list.values())
        val+=item + "<br>"; 
        document.getElementById("demo").innerHTML = val
     }
}