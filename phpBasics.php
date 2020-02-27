<?php

    //1. Create a variable called yourName.  Assign it a value of your name.
    $yourName = "Abigail";   //Datatype: String Scope:Global
    //4.Create the following variables:  number1, number2 and total.  Assign a value to them.  
    $number1 = 2;
    $number2 = 7;
    $total = $number1+$number2;
?>
<script>

    
    </script>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP Basics</title>
</head>
<body>
    <h1>WDV 342 Intro PHP</h1>
    <!-- 2. Display the assignment name in an h1 element on the page. Include the elements in your output. -->
    <?php 
    echo "<h2> PHP Basics </h2>";

    echo "<h2> $yourName </h2>" ;
    echo "<h3> Number 1: $number1 </h3>";
    echo "<h3> Number 2:   $number2 </h3>";
    echo "<h2> Total: $total </h2>" ;
     ?>

    <script>
    <?php
    //Use PHP to create a Javascript array with the following values: PHP,HTML,Javascript.  Output this array using PHP.  Create a script that will display the values of this array on your page.  NOTE:  Remember PHP is building the array not running it.  


        echo "let languages =['PHP', 'HTML', 'Javascript'];";

        echo "for(let i=0; i < languages.length; i++){
                document.write(languages[i]+ ' ' );
                }";
    ?>
</script>

</body>
</html>