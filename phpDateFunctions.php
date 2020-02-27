<?php 

//1. Create a function that will accept a date input and format it into mm/dd/yyyy format.
    function dateFormat($date){
        echo "<br> mm-dd-yyyy: " . date("m/d/Y") . "<br>";
    } 

    function makeDateFormat2(){
        echo "<br> dd-mm-yyyy: " . date("d/m/Y") . "<br>";
    }
    function outputFullName1(){

        global $fName, $lName;   //accesses global variable 

        echo "$lName, $fName";
        echo "<br>";
        echo $lName . ", " . $fName;
        echo "<br";
    }

    function outputFullName2($inFirstName, $inLastName){
        echo "$inLastName, $inFirstName";
        echo "<br>";
        echo $inLastName . ", " . $inFirstName;
    }

    function outputFullName3($inFirstName, $inLastName){
        return $inLastName . ", " . $inFirstName;
    }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP Unit 3 PHP</title>
</head>

<body>
    <h1> Function </h1>

    <div>
        <h3>Student Roster 1</h3>
        <?php
            outputFullName1();
        ?>
    </div>

    <div>
        <h3>Student Roster 2</h3>
        <?php
            outputFullName2('Abby', 'Husske');
            outputFullName2('Emery', 'Zeiser');
        ?>
    </div>

    <div>
        <h3>Student Roster 3</h3>
        <?php
            echo outputFullName3('Abby', 'Husske');
            $fullName = outputFullName3('Abby', 'Husske');
            echo "<br> 3Hello" . " " . $fullName;

            //Day of week in text
            makeDateFormat1();
            makeDateFormat2();
        ?>
    </div>
</body>
</html>