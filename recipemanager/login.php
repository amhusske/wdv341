<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();  //start or join new session

$message = "";
//$_SESSION['validUser'] = "";
$inUsername = "";
//$validUser = $_SESSION['validUser'];

//echo ("Valid User: " . $_SESSION['validUser']. "<br>");

    if($_SESSION['validUser'] == "yes"){
        $message = "Welcome back!" . $inUsername;
    }
    else{
        if(isset($_POST['submitLogin'])){

            $inUsername =  $_POST['loginUsername'];

                try{
                require 'recipeForm/dbConnect.php';				//Connect to the database

                $sql = "SELECT";
               $sql .= "*";
                
                //$sql .= "user_name,";
                //$sql .= "user_password";
                $sql .= "FROM recipe_user WHERE user_name = :username AND user_password = :password ";				
   
                $stmt = $conn->prepare($sql);	//prepare the query
			
                $stmt->bindParam(':username', $_POST['loginUsername'], PDO::PARAM_STR);
                $stmt->bindParam(':password',  $_POST['loginPassword'], PDO::PARAM_STR);		

                $stmt->execute(); 
                
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $inUsername = $row['user_name'] ;  
                  //echo "UserName: " .$inUsername; 
                  $userID = $row['user_id'];
                  //echo "UserId: " . $userID;   
                  
                  $_SESSION['userID'] = $userID;
                }


                }
                catch(PDOException $e){
                    $message = "There was a problem. We will fix it! Please try again.";

                    error_log($e->getMessage());
                    error_log($e->getLine());
                    error_log(var_dump(debug_backtrace()));

                }

                $row = $stmt->rowCount();

                    if($row == 1){
                        $_SESSION['validUser'] = "yes";
                        $message = "Welcome $inUsername!" ;

                    }

                    else
                    {
                        $_SESSION["validUser"] = "no";					
                        $message = "Sorry, there was a problem with your username or password. Please try again.";
                    }
            //echo("Rows: " . $row);

    }
}
        
    
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<meta charset= "utf-8" >
<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--  User Login Page
            
if user is valid (Session variable - already logged on)
	display admin options
else
    if form has been submitted
        Get input from $_POST
        Create SELECT QUERY
        Run SELECT to determine if they are valid username/password
        if user if valid
            set Session variable to true
            display admin options
        else
            display error message
            display login form
    else
    display login form
         
-->

<link rel="stylesheet" href="styling/indexStyle.css">
<link rel="stylesheet" type="text/css" href="sampleRecipes/recipeManagerStyle.css">


</head>

<body>


<nav>
    
            <h2>Recipe Manager</h2>
            
        </nav>

        <div class="green">
                <a href="index.html">Home</a>
                <a href="sampleRecipes/recipeBook.html">Sample Recipes</a>
                <a href="login.php">Login</a>
            

        </div>

        <h3><?php echo $message?></h3>

<?php 


    if ($_SESSION['validUser'] == "yes"){

       // echo("<h2>" . $message . $inUsername2  . "</h2>") ;
    ?>
                <h2>Recipe Administrator Options</h2>

      <div class="shadowBox"> 
        <p><a href="recipeForm/recipeForm.php">Add A Recipe</a></p>
        <p><a href="selectRecipes.php">My Recipes</a></p>
        <p><a href="deleteRecipe.php">Delete Recipe</a></p>	
        <p><a href="logout.php">Log Out</a></p>	
    </div>
<?php 

}
else {
?>
<div class="formBox">
	<h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>

</div>

                
                <?php
                    }
                ?>
<p>Return to <a href='#'>www.abbyhusske.com</a></p>


</body>
</html>