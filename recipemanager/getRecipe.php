
<?php 

session_start();

$inVal = intval($_GET['q']);
//echo $inVal;
//echo $_SESSION['userID'];

try {
  
  require 'recipeForm/dbconnect.php';	//CONNECT to the database
  
  
  //Create the SQL command string
  $sql = "SELECT ";
  $sql .= "name, ";
  $sql .= "id, ";
  $sql .= "category, ";
  $sql .= "description, ";
  $sql .= "difficultyLevel, ";
  $sql .= "servings, ";
  $sql .= "amount, ";
  $sql .= "ingredients, ";
  $sql .= "unit, ";
  $sql .= "prepTime, ";
  $sql .= "cookTime, ";
  $sql .= "tools, ";
  $sql .= "instructions ";
  $sql .= "FROM recipes WHERE user_num = :userID AND id = :inVal";
  
  
  //PREPARE the SQL statement
  $stmt = $conn->prepare($sql);
  
  $stmt->bindParam(':userID', $_SESSION['userID'], PDO::PARAM_STR);
  $stmt->bindParam(':inVal', $inVal, PDO::PARAM_STR);

  //EXECUTE the prepared statement
  $stmt->execute();		
  
  //Prepared statement result will deliver an associative array
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {

    $ingredients = json_decode($row['ingredients'],true);
    $insructions = json_decode($row['instructions'], true);
    $amounts = json_decode($row['amount'], true);
    $unit = json_decode($row['unit'], true);

    $count =  count($ingredients);

	
	echo"<div id='recipeInfo'>";
		echo"<h2 id='recipeName'>" . $row['name']   . "</h2>";
		echo"<h3 id='recipeCategory'>" .'Category : ' . $row['category']  . "</h3>";
		echo"<h3 id='recipeDescription'>" . 'Description : ' . $row['description']  ."</h3>";
		
		echo"<div class='row'>";
			echo"<div class='column'>";
				//<img id="recipeImage"></img>
			echo"</div>";

			echo"<div class='column shadowBox'>";
            echo"<h4 id='recipeServing'>" . 'Servings : ' .  $row['servings'] . "</h4>";
			echo"<h4 id='recipeDifficulty'>". 'Difficulty Level : ' . $row['difficultyLevel'] .  "</h4>";
			echo"<h4 id='preparationTime'>". 'Prep Time : ' .  $row['prepTime'] ."</h4>";
			echo"<h4 id='cookTime'>" . 'Cook Time: ' .  $row['cookTime'] . "</h4>";
			echo"<h4>Equipment Needed</h4>";
				echo"<div id='tools'>". $row['tools'] . "</div>";
			echo"</div>";
		echo"</div>";
	echo"</div>";

	

	
		echo"<div class='column'>";
			echo"<h5>Ingredients <i class='showHide rotate'></i></h5>";
				echo"<ul id='recipeIngredients'>";
                for($i = 0; $i < $count; $i++){
                    echo"<li>" . $amounts[$i] . " " .  $unit[$i] . " " . $ingredients[$i] . "</li> " ;}
				echo"</ul>";

			echo"<h5>Instructions<i class='right rotate'></i></h5>";
				echo"<ol id='recipeInstructions'>";
                foreach($insructions as $value){
                    echo "<li>" . $value . "</li>" ;
                }
				echo"</ol>";
		
		echo"</div>";
  }
/*
  echo "<table>
<tr>
<th>Name</th>
<th>Category</th>
<th>Description</th>
<th>Difficulty Level</th>
<th>Servings</th>
<th>Intgredients</th>
<th>Intructions</th>

</tr>";

while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {

    $ingredients = json_decode($row['ingredients'],true);
    $insructions = json_decode($row['instructions'], true);
    $amounts = json_decode($row['amount'], true);
    $unit = json_decode($row['unit'], true);

    $count =  count($ingredients);


    echo "<tr>";
    echo "<td>" . $row['name'] .  "</td>";

    echo "<td>" . $row['category'] . "</td>";
  
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['difficultyLevel'] . "</td>";
    echo "<td>" . $row['servings'] . "</td>";

    for($i = 0; $i < $count; $i++){
        echo"<td>" . $amounts[$i] . " " .  $unit[$i] . " " . $ingredients[$i] . "</td> " ;}
 

    foreach($insructions as $value){
        echo "<td>" . $value . "</td>" ;
    }

    echo "</tr>";
}

echo "</table>";
}*/
} 
catch(PDOException $e)
{
  $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

  error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
  error_log($e->getLine());
  error_log(var_dump(debug_backtrace()));

  //Clean up any variables or connections that have been left hanging by this error.		

  //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
}

?>
