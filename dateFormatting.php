
<?php 

//1. Create a function that will accept a date input and format it into mm/dd/yyyy format.
    function dateFormat($inDate){
        echo "mm/dd/yyyy: " . date("m/d/Y",strtotime($inDate));
        echo "<br>";

    } 

// 2. Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates.
    function dateFormat2($inDate){
        echo "dd/mm/yyyy: " . date("d/m/Y",strtotime($inDate)) ;
        echo "<br>";
    }
    
// 3. Create a function that will accept a string input.  It will do the following things to the string:
//    a.Display the number of characters in the string
//    b.Trim any leading or trailing whitespace
//    c.Display the string as all lowercase characters
//    d.Will display whether or not the string contains "DMACC" either upper or lowercase

    function countTrimLower($inVal){
        echo "a. " . strlen($inVal) . "<br>";
        echo "b. " . trim($inVal) . "<br>";
        echo "c. " . strtolower($inVal) . "<br>";

        if (stripos($inVal,"DMACC") !== false) {
            echo "$inVal DOES contains DMACC";
        }
        else{
            echo "$inVal does NOT contain DMACC";

        }
    }

    // 4. Create a function that will accept a number and display it as a formatted number.   Use 1234567890 for your testing.
    function formatNum($inNum){
        echo number_format($inNum,2)."<br>";
    }


   // 5. Create a function that will accept a number and display it as US currency.  Use 123456 for your testing.
   function formatUsCurrency($inNum){
    echo  '$' . number_format($inNum,2)."<br>";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP Unit 3 PHP</title>
</head>

<body>
    <h1> Date Functions </h1>

    <div>
        <h3>Date Formatting</h3>
        <?php
            dateFormat("1/13/20");
            dateFormat2("Yesterday");
            echo "<h3> Count, Trim, Lower, Locate DMACC</h3>";
            countTrimLower("AbigialHusske@DMACC");
            echo "<h3> Format Number</h3>";
            formatNum(1234567890);
            echo "<h3> Format Number to Currency</h3>";
            formatUsCurrency(123456);
        ?>
    </div>

  
</body>
</html>