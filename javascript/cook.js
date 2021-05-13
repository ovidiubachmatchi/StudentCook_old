var ingredients_list = new Set()

function put_ingredient(ingredient){
    if (!(ingredient == ""))
    ingredients_list.add(ingredient)
    show_ingredients()
}
// show recipes
function showRecipes() {
  if (ingredients_list.size != 0){
  var ingredients = [...ingredients_list].join(' ')
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("recipes").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/get_recipes.inc.php?ingredients="+ingredients, true);
  xhttp.send();
  }
}

function show_ingredients(){
    var val = ""
     if (ingredients_list.size == 0){
     document.getElementById("ingredients_section").innerHTML = "There are no ingredients"
     document.getElementById("show_recipes").style.display = "none"
     }
     else
     {
       document.getElementById("show_recipes").style.display = "block"
        for (item of ingredients_list.values())
        {
        var button = `<span class="close" onclick="delete_ingredient('`+item+`')"><i class="fas fa-trash"></i></span>`
        val += "<li>"+button+item+"</li>";
        }
        document.getElementById("ingredients_section").innerHTML = val
     }
}
function delete_ingredient(ingredient){
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
function signupSuccess() {
openSignUpForm();
document.getElementById('error_signup').innerHTML = 'You have signed up';
}
function passwordTooShort() {
  openSignUpForm();
  document.getElementById('error_signup').innerHTML = 'Password is too short';
}
function stmtFailedSignup() {
  openSignUpForm();
document.getElementById('error_signup').innerHTML = 'Something went wrong';
}
function emailAlreadyTaken() {
  openSignUpForm();
  document.getElementById('error_signup').innerHTML = 'This email is already taken';
}
function invalidEmailFormat() {
  openSignUpForm();
  document.getElementById('error_signup').innerHTML = 'Invalid email format';
}
function passwordRepeatError() {
  openSignUpForm();
  document.getElementById('error_signup').innerHTML = 'Please re-enter your password';
}
function emptyinputSignup() {
  openSignUpForm();
  document.getElementById('error_signup').innerHTML = 'Please fill out all the required fields';
}
function emptyInputLogin() {
  openForm();
  document.getElementById('error_login').innerHTML = 'Please fill out all the required fields';
}
function wrongEmail() {
  openForm();
  document.getElementById('error_login').innerHTML = 'This email is not registered';
}
function wrongPassword() {
  openForm();
  document.getElementById('error_login').innerHTML = 'Wrong password!';
}
function stmtFailedLogin() {
  openForm();
  document.getElementById('error_login').innerHTML = 'Something went wrong';
}
function show_recipes() {
  
}