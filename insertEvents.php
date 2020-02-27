<?php
    // This PHP file will connect to the wdv341 database
    // Pull the form data from the $_POST variable
    // Format an INSERT SQL statement
    // Create a Prepared Statement
    // Bind the parameters to the Prepared Statement
    // Execute the Prepared Statement to insert into the database
    // Display a success/failure message to the user.

    require 'dbconnect.php';    // access and run this external file for connection
try{
    $eventName = "WDV341 Intro PHP";
    $eventDescription = "We are inserting into a database";
    $eventDate = '2020-08-08';
    $eventTime = '20:00:00';
    $eventPresenter = "Dwight Schrute";

    // PDO Prepared Statements
    //1. Create sql statement w/ name placeholders
    $sql = "INSERT INTO wdv341_event(event_name, event_description, event_date, event_time, event_presenter)
    VALUES(:eventName, :eventDescription, :eventDate, :eventTime, :eventPresenter)";

    //2. Create the prepared statment object by passing the statement into the prepare function
    $stmt = $conn->prepare($sql);

    //3. Bind paramters to the prepared statment object
    $stmt->bindParam(':eventName', $eventName);
    $stmt->bindParam(':eventDescription', $eventDescription);
    $stmt->bindParam(':eventDate', $eventDate);
    $stmt->bindParam(':eventTime', $eventTime);
    $stmt->bindParam(':eventPresenter', $eventPresenter);


    //4. Execute the prepared statment object
    $stmt->execute();

/*
    $eventName = "Nutcracker Christmas";
    $eventDescription = "The Office themed Christmas party";
    $eventPresenter = "Party Planning Committee";
    $eventDate = "2020-12-25";
    $eventTime = "17:00:00";
    $stmt->execute();


    $eventName = "Margarita-Karaoke-Christmas";
    $eventDescription = "Karaoke Christmas";
    $eventPresenter = "The Committee to Plan Parties";
    $eventDate = "2020-12-25";
    $eventTime = "17:00:00";
    $stmt->execute();

    */
}

catch(PDOException $e){
    echo "WARNING";
}

echo "<h2 style='text-align: center;color:white;'>Success!</h2>";
echo "<body style='background-color: green;'>";

$conn = null;  //close your connection object
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Untitled Document </title>
</head>
<body>
</body>
</html>