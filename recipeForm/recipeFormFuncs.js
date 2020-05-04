
 let count = 0;

function addIngredient(){
    alert('in function');

    ingredients = document.getElementById('ingredients');    //obtain element from document with getElement ID
    
    ingredient = document.createElement('div');   //  ingredient amount (numeral)
    ingredient.setAttribute("id", "ingredientRow");

    // Create 3 divs
    amountDiv = document.createElement('div');   //  ingredient amount (numeral)
    unitDiv = document.createElement("div");  // ingredient unit (cups, tbs, etc)
    ingredientNameDiv = document.createElement('div'); // igredient name


    // Uses makeInput element to create element and append to the above divs
    makeInputTextElement("Ingredient", "ingredient[]", ingredientNameDiv, 10);
    makeInputTextElement("Amount", "amount[]", amountDiv, 10);
    makeInputTextElement("Unit", "unit[]", unitDiv, 5);

    //Those divs are then appended to the main div of ingredients

    ingredient.append(amountDiv );
    ingredient.append(unitDiv);
    ingredient.append(ingredientNameDiv);

    ingredients.append(ingredient);
   
   // count++;
};


function addStep(){

    steps = document.querySelector('#instructions');
    
    AddStep = document.createElement('div');
    makeInputTextElement("Step " + (count+1) , "instructions[]", AddStep, 20);

    steps.append(AddStep);
    count++;
}




// Creates an input text element witht the Label display, element name, and size passed in. Appends to passed in element
function makeInputTextElement(displayName, elementName, el, inSize){
   let  element = "<label for =" +  elementName + ">"  + displayName + " </label> <br>"; 
        element += "<input type='text' name= " + elementName + " size=" + inSize + "id= " + elementName + ">";
          
        el.innerHTML += element;
} 




 

function showForm(){
    let recipeForm = "<form id='recipe' method='post' action='recipeForm.php'> <label for='recipeName'>Recipe Name:</label><br><input type='text' id='recipeName' name='recipeName'><br> <label for='description'>Short Description: </label><br><input type='text' id='description' name='description'><br><label for='servings'>Servings: </label><br><input type='text' id='servings' name ='serving'><br><label for='prepTime'>Prep Time: </label><br><input type='text' id='prepTime' name='prepTime'><br><label for='difficultyLevel'>Difficulty Level: </label><br><select id ='diffuicultyLevel' name = 'difficultyLevel'><option value= 'easy'>Easy</option><option value='medium'>Medium</option><option value='hard'>Hard</option><option value='expert'>Expert</option></select> <br><label for='recipeCookTime'>CookTime: </label><br><input type='text' id='recipeCookTime' name ='recipeCookTime' size='10'><br><label for='tools'>Needed Equipment: </label><br><input type='text'id='tools' name ='tools'><br><h3>Add as many ingredients as needed</h3><div id='ingredients'></div><button type='button' value='AddIngredient'onclick='addIngredient()'>Add Ingredient</button><td><input type='submit' id='submitBio' name='submitBio' value='Submit Bio' /></td><input type='reset' name='button2' id='button2' value='Reset' /></form>"
}

document.addEventListener("DOMContentLoaded", function() {


let reset = document.getElementById('button2');

reset.addEventListener("click", function(){
    document.getElementById('ingredients').innerHTML = "";    //obtain element from document with getElement ID
    document.getElementById('instructions').innerHTML = "";
    });

});