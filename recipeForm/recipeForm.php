<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.

//Join session
session_start();

if($_SESSION['validUser'] != "yes"){
  header('Location: index.php');
}

  $message = "";

  //Ingredient Info fields
  $category = "";
  $recipeName = "";
  $recipeDescription ="";
  $servings = "";
  $amounts = "";
  $prepTime = "";
  $prepTimeUnit = "";
  $cookTime = "";
  $cookTimeUnit = "";
  $difficultyLevel = "";
  $tools = "";


  //Ingredient Fields
  $units = "";
  $amounts = "";
  $ingredients = "";

  //Instruction Step
  $instructions = "";

//Error Messages
  //Ingredient Info fields
  $categoryErr = "";
  $recipeNameErr = "";
  $recipeDescriptionErr ="";
  $servingsErr = "";
  $amountsErr = "";
  $prepTimeErr = "";
  $prepTimeUnitErr = "";
  $cookTimeErr = "";
  $cookTimeUnitErr = "";
  $difficultyLevelErr = "";
  $toolsErr = "";

  //Ingredient Fields
  $unitsErr = "";
  $amountsErr = "";
  $ingredientsErr = "";

  //Instruction Step
  $instructionsErr = "";


  $validForm = false;

      If(isset($_POST['submitBio'])){

        $userID = $_SESSION['userID'];
        //Assign value from associated post value to variable
        $category = $_POST['recipeCategory'];
        $recipeName = $_POST['recipeName'];
        $recipeDescription = $_POST['description'];
        $servings = $_POST['servings'];
        $prepTime = $_POST['prepTime'];
        $prepTimeUnit = $_POST['prepTimeUnit'];

        $fullPrepTime = $prepTime . " " .$prepTimeUnit;

        $cookTime = $_POST['cookTime'];
        $cookTimeUnit = $_POST['cookTimeUnit'];

        $fullCookTime = $cookTime . " " . $cookTimeUnit;

        $difficultyLevel = $_POST['difficultyLevel'];
        $tools = $_POST['tools'];

        /* FORM VALIDATION

        FIELD           QUALIFICATION
        name            cannot be empty, charcter/letters only

        category        must be one of option choices "breakfast" , "lunch", "dinner", "desserts", or "snacks"
                        
        description     chacarters/letters/puncuation only
                        cannot be empty
                        up to 40 chars

        servings        cannot be empty
                        must be numeric

        prepTime        cannot be empty
                        must be numeric

        prepTimeUnit    must be one of option choices "minutes", "hour(s)", "day(s)"

        cookTime        cannot be empty
                        must be numeric

        cookTimeUnit    must be one of option choices "minutes", "hour(s)", "day(s)"

        difficultyLevel must be one of option choices "easy", "medium", "hard"         

        tools            characters/letters/puncuation only
        
        */

        //VALIDATION FUNCTIONS

        function validateName($inName){
          global $validForm, $recipeNameErr;

          if($inName == ""){
            $validForm = false;
            $recipeNameErr = "You must enter a recipe name!";
          }
        } // End name validation


        function validateDescription($inDes){
          global $validForm, $recipeDescriptionErr;

          if(strlen($inDes) > 40){
            $validForm = false;
            $recipeDescriptionErr = "Description is only up to 40 characters";
          }

          else if($inDes == ""){
            $validForm = false;
            $recipeDescriptionErr = "Please enter a Description";
          }
        }// End description validation

        function validateCategory($inCat){
          global $validForm, $categoryErr;

          if(!($inCat == 'breakfast' || $inCat == "lunch" || $inCat == "dinner" || $inCat == "desserts" || $inCat == "snacks")){
            $validForm = false;
            $categoryErr = "Please choose from the options given";
          }
        }// End validate category


        function validateServings($inServ){
          global $validForm, $servingsErr;

          if(empty($inServ)) {
            $validForm = false;
            $servingsErr = "Please enter a value" ;
          } 
          else if(!is_numeric($inServ)) {
            $validForm = false;
            $servingsErr = "Numbers Only";
          }
        }// End validate servings


        function validatePrepTime($inTime){
          global $validForm, $prepTimeErr;

          if(empty($inTime)) {
            $validForm = false;
            $prepTimeErr = "Please enter a value. Ex: 2.5, 1, .5 " ;
          } 
          else if(!is_numeric($inTime)) {
            $validForm = false;
            $prepTimeErr = "Numbers Only";
          }
        }//end validate prep time

        function validateCookTime($inTime){
          global $validForm, $cookTimeErr;

          if(empty($inTime)) {
            $validForm = false;
            $cookTimeErr = "Please enter a value. Ex: 2.5, 1, .5 " ;
          } 
          else if(!is_numeric($inTime)) {
            $validForm = false;
            $cookTimeErr = "Numbers Only";
          }
        }//end validate cook time

        $validForm = true;
        validateName($recipeName);
        validateCategory($category);
        validateServings($servings);
        validateDescription($recipeDescription);
        validatePrepTime($prepTime);
        validateCookTime($cookTime);


        //Get ingredient fields and encode into JSON format
        $amounts = json_encode($_POST['amount']);
        $units =json_encode( $_POST['unit']);
        $ingredients = json_encode($_POST['ingredient']);

        //Get instruction fields and encode into JSON format
        $instructions = json_encode($_POST['instructions']);

  //$userID = 1;
  if($validForm){

    $message = "all good";
    try{
        require 'dbconnect.php';

        $sql = "INSERT into recipes(";
        $sql.= "user_num,";
        $sql.= "category,";
        $sql.= "name,";
        $sql.= "description,";
        $sql.= "servings,";
        $sql.= "prepTime,";
        $sql.= "cookTime,";
        $sql.= "difficultyLevel,";
        $sql.= "tools,";
        $sql.= "amount,";
        $sql.= "unit,";
        $sql.= "ingredients,";
        $sql.= "instructions";
        $sql.= ")VALUES( :userID, :category, :name, :description, :servings, :prepTime, :cookTime, :difficultyLevel, :tools, :amount, :unit, :ingredients, :instructions)";

        $stmt = $conn->prepare($sql);

        //Bind variables to named placeholders
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':name', $recipeName);
        $stmt->bindParam(':description', $recipeDescription);
        $stmt->bindParam(':servings', $servings);
        $stmt->bindParam(':prepTime', $fullPrepTime);
        $stmt->bindParam(':cookTime', $fullCookTime);
        $stmt->bindParam(':difficultyLevel', $difficultyLevel);
        $stmt->bindParam(':tools', $tools);
        $stmt->bindParam(':amount', $amounts);
        $stmt->bindParam(':unit', $units);
        $stmt->bindParam(':ingredients', $ingredients);
        $stmt->bindParam(':instructions', $instructions);


        $stmt->execute();

        $messsage = "ADDED";
    }

    catch(PDOException $e){

        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

        error_log($e->getMessage());	//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log(var_dump(debug_backtrace()));
    
        //Clean up any variables or connections that have been left hanging by this error.		
    
        //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
      }

    }//closing brack for if it's a valid form 

    else{
      //Not a valid form
      $message= "something isn't valid";
      }

    } //closing brack for 'if the form was submitted'

  else{
    //form hasn't been seen
};

?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Enter Recipe</title>
<script src='recipeFormFuncs.js'></script>

<link rel="stylesheet" href="formStyle.css">

<style>

#ingredientAmount, #ingredientName{
    display: flex;
    flex-direction: row;
}

</style>


<link rel="stylesheet" type="text/css" href="../sampleRecipes/recipeManagerStyle.css">
	<link rel="stylesheet" type="text/css" href="../styling/indexStyle.css">
	<link rel="stylesheet" type="text/css" href="formStyle.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php

echo $message;

echo "<a href='http://localhost/wdv321/recipeManager/recipeForm/recipeForm.php'> Add another recipe </a>";
?>

<div id="container">
<nav>
		<h2>Recipe Manager</h2>
		
	</nav>

	<div class="green">
		<a href="../sampleRecipes/recipeBook.html">View Sample Recipes</a>
		<a href ="../login.php">Login</a>
	</div>
	
<h2>Enter a Recipe</h2>
<?php 
if($validForm)
  { 
?>

<h1><?php echo $message ?></h1>

<?php 
  }
  else
  {
?>
<div id= "formContainer">
  <form id="recipe" method="post" action="recipeForm.php"> 
    <label for="recipeCategory">Category: </label><br>
    <select id="category" name="recipeCategory">
          <option value = "breakfast" default> Breakfast </option>
          <option value = "lunch">Lunch</option>
          <option value = "dinner">Dinner</option>
          <option value = "dessert">Dessert</option>
          <option value = "Snack">Snack</option>

        </select><br>

        <div class="across">

      <label for="name">Recipe Name:</label>
      <input type="text" id="name" name="recipeName" value="<?php echo $recipeName; ?>" > 
      <span class="errMsg"> <?php echo $recipeNameErr; ?></span>
      <br>
    
 
  <label for="description">Short Description: </label>
    <input type="text" id="description" name="description" value="<?php echo $recipeDescription; ?>">
    <span class="errMsg"> <?php echo $recipeDescriptionErr; ?></span>
    <br>
  <label for="servings">Servings: </label>
    <input type="text" id="servings" name ="servings" value="<?php echo $servings; ?>">
    <span class="errMsg"> <?php echo $servingsErr; ?></span>
    <br>
    </div>

    <div class="across">
      <label for="prepTime">Prep Time: </label>
        <input type="text" id="prepTime" name ="prepTime" size= '4'>

      <select id="prepTimeUnit" name="prepTimeUnit" value="<?php echo $prepTime; ?>">
        <option value = "minutes" default>Minutes </option>
        <option value = "hours">Hour(s)</option>
        <option value = "days">Day(s)</option>
      </select>
      <span class="errMsg"> <?php echo $servingsErr; ?></span>
      <br>
    </div>

    <div class="across">
      <label for="cookTime">Cook Time: </label>
      <input type="text" id="cookTime" name ="cookTime" size='4'>

      <select id="cookTimeUnit" name="cookTimeUnit" value="<?php echo $cookTime; ?>">
        <option value = "minutes" default required>Minutes</option>
        <option value = "hours">Hour(s)</option>
        <option value = "days">Day(s)</option>
      </select>
      <span class="errMsg"> <?php echo $servingsErr; ?></span>
      <br>
    </div>

    <label for="difficultyLevel">Difficulty Level: </label>
    <select id ="diffuicultyLevel" name = "difficultyLevel">
        <option value= "easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
        <option value="expert">Expert</option>
    </select> <br>

    <label for="tools">Kitchen equipment needed: </label>
    <input type="text" id="tools" name ="tools"><br>


    <h3> Add as many ingredients as needed </h3>
      <div id="ingredients">
        
      </div>
    
      <button type="button" value="AddIngredient" onclick="addIngredient()">Add Ingredient</button>
  
    <h3> Add instruction steps below</h3>

      <div id="instructions">
       
    
      </div>

    <button type="button" value="addStep" onclick="addStep()">Add Step</button>
    
</div>

    <input type="submit" id="submitBio" name="submitBio" value="Add Recipe" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </form>
  </div> <!-- close formContainer -->
<?php 
  }
  ?>

</body>
</html>