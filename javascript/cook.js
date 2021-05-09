var ingredients_list = new Set()

function put_ingredient(ingredient){
    if (!(ingredient == ""))
    ingredients_list.add(ingredient)
    show_ingredients()
}
function show_ingredients(){
    var val = ""
     if (ingredients_list.size == 0)
     document.getElementById("ingredients_section").innerHTML = "There are no ingredients"
     else
     {
        for (item of ingredients_list.values())
        {
        var button = `<span class="close" onclick="delete_ingredient('`+item+`')"><i class="fas fa-trash"></i></span>`
        val += "<li>"+button+item+"</li>";
        }
        document.getElementById("ingredients_section").innerHTML = val
     }
}
function delete_ingredient(ingredient){
    var res = ingredient.slice(0, 5);
    console.log(ingredient.slice(1,2))
    ingredients_list.delete(ingredient)
    show_ingredients()
}
function openForm() {
  document.getElementById('blur_overlay').classList.add("blur");
  $("#login").fadeIn(100);
  $("#signup").hide();
}
function openSignUpForm() {
  $("#signup").fadeIn(100);
  $("#login").hide();
}
function closeForm() {
  document.getElementById('blur_overlay').classList.remove("blur");
   $("#login").hide();
   $("#signup").hide();
 }

