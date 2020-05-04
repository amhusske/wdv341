<?php
        require 'Emailer.php';


        If(isset($_POST['contactBtn'])){

        $emailTest = new Emailer();

        $emailTest->set_senderEmail("amhusske1@gmail.com");
        echo "Sender: " . $emailTest->get_senderEmail();
        echo "<br>";

        $emailTest->set_recipientEmail($_POST['email']);
        echo "Recipient: " . $emailTest->get_recipientEmail();
        echo "<br>";

        $emailTest->set_subject("Recipe Manager Contact");
        echo "Subject: " . $emailTest->get_subject();
        echo "<br>";

        $emailTest->set_message($_POST['message']);
        echo $emailTest->get_message();
        
       // echo $emailTest->get_recipientEmail();

        $result = $emailTest->sendEmail();  // send email to SMTP server
        
        //echo $result;
        

    }else { 

        
    ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>

<link rel="stylesheet" type="text/css" href="sampleRecipes/recipeManagerStyle.css">
<link rel="stylesheet" type="text/css" href="styling/indexStyle.css">
<link rel="stylesheet" type="text/css" href="styling/myRecipesStyle.css">


</head>
<style>

h1{
    text-align: center;
    padding: 5%;
}


#container{
    display: flex;
    justify-content: center;
}

form{
    margin-top: 20px;
}

label{
    display: inline-block;
    width: 100px;
    text-align: right;
    font-size: 125%;
}

input{
    height: 30px;
}

 input{
    margin-bottom: 18px;
}

#btn{
    width: 100px;
    font-size: 130%;
    margin-top: 20px;
    margin-left: 50%;
}
</style>

<body>

    <nav>
        <h2>Contact</h2>
    </nav>
    <div class="green">
                <a href="index.html">Home</a>
                <a href="sampleRecipes/recipeBook.html">Sample Recipes</a>
                <a href="contactUs.php">Contact Us</a>
                <a href="login.php">Login</a>
    </div>

    <h1> Send Us a Message!</h1>

    <div id="container">
        <form name="contact" method="post" action="contactUs.php">

        <label for="fname"> First Name </label>
        <input type="text" name="fname"><br>
    
        <label for="email"> Email </label>
        <input type="text" name="email"><br>

        <label for="message"> Message </label>
        <textarea name="message"></textarea><br>

        <input type="submit" id="btn" name="contactBtn" value="Send"/> 

    </form>
    </div>

<?php } 
echo $result;
?>

</body>
</html>