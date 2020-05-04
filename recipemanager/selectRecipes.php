<?php

session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.

session_start();

$userid = $_SESSION['userID'];
//echo $userid;

    if($_SESSION['validUser'] != "yes"){
    header('Location: index.php');
    }
        try {
  
        require 'recipeForm/dbconnect.php';	//CONNECT to the database
  
  
        //Create the SQL command string
        $sql = "SELECT ";
        $sql .= "name, ";
        $sql .= "id ";
        $sql .= "FROM recipes WHERE user_num = :userID";
  
  
        //PREPARE the SQL statement
        $stmt = $conn->prepare($sql);
  
        $stmt->bindParam(':userID', $_SESSION['userID'], PDO::PARAM_STR);

        //EXECUTE the prepared statement
        $stmt->execute();		
  
        //Prepared statement result will deliver an associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Recipes</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="sampleRecipes/recipeManagerStyle.css">
<link rel="stylesheet" type="text/css" href="styling/indexStyle.css">
<link rel="stylesheet" type="text/css" href="styling/myRecipesStyle.css">


    
<script>

document.addEventListener("DOMContentLoaded", function() {

  

let choice = document.getElementById('myRecipes');

choice.addEventListener("change", function(){
    
    let value=choice.value;
    //alert(value);

    if (value == "") {
        document.getElementById("dynamic").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dynamic").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getRecipe.php?q="+value,true);
        xmlhttp.send();
    }

    });
});

</script>

</head>
<style>


</style>
<body>

<div id="container">

<nav>

<h2>My Recipes</h2>
</nav>


<div class="green">
                <a href="index.html">Home</a>
                <a href="sampleRecipes/recipeBook.html">Sample Recipes</a>
                <a href="contactUs.php">Contact Us</a>
                <a href="login.php">Login</a>
        </div>

<main>


  
<div class="userRecipes">
    <select id="myRecipes" >
    <option value="">Select A recipe </option>
    <?php 
    
        while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>		
                
                <option value = <?php echo $row['id'] ?> ><a href="#"><?php echo $row['name']; ?></a></option>
                
    <?php
        }
    ?>	

    </select>
    </div>
    
    
</main>

<div id="dynamic">


</div>

<footer>
    <p>Copyright &copy; <script> var d = new Date(); document.write (d.getFullYear());</script> All Rights Reserved</p>

</footer>




</div>
</body>
</html>