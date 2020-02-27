<?php

    $firstName = "Abigail";   //Datatype: String Scope:Global
    $lastName = "Husske";     //^^^^^^


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP starter</title>
<style>
    body{
        background-color: lightslategray;
        <?php

            $counter = 22; 
            if($counter<12){
            echo "color:darkgreen;";
            }
            else{
                echo "color:red;";
            }
        ?>
    }
</style>
</head>
<body>
    <h1>WDV 342 Intro PHP</h1>
    <h2>Monday Nights 6-10p</h2>
    <?php
        echo "<h5>Where's Echo</h5>";

    ?>
    <p>Hello World</p>
    <h2>Hello <?php echo $firstName." ".$lastName ?></h2>
    <p>This is a paragraph</p>
    
    <?php
        echo "<h3>PHP Wrote this line</h3>";
    ?>

    <script>
        <?php
            echo "let name ='Hannah';"; 
            echo "let cars =['Volvo', 'Saab', 'Kia', 'Porsche'];";

            echo "for(let i=0; i < cars.length; i++){
                document.write(cars[i]+ ' ' );
            }";
        ?>
        console.log(cars)
        document.write("<br> name variable: " + name);
        console.log(name);
    </script>

    

    <?php 
        echo "<p> This is output by PHP on the server. </p>"
    ?>

<style>
        <?php
            echo "h2 {background-color: lightblue;}"; 
            echo "h1 {color: green;}";
            echo "h1:hover {color: red;}";
            echo "p {text-align: center;}";
        ?>
    </style>

</body>
</html>
