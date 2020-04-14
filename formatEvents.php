<?php

try{
	//Get the Event data from the server.
	require '../dbconnect.php';	//CONNECT to the database
  
	  //Create the SQL command string
	  $sql = "SELECT ";
	  $sql .= "event_name, ";
	  $sql .= "event_description, ";
	  $sql .= "event_date, ";
	  $sql .= "event_time, ";
      $sql .= "event_presenter ";
	
	  $sql .= "FROM wdv341_event ";
	  
	  $dql .= "ORDER BY event_presenter DESC";
      
	  
	  //PREPARE the SQL statement
	  $stmt = $conn->prepare($sql);
	  
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
  
	  header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text-align:left;
			font-size:18px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}

		.italic{
			font-style: italic;
		}

		.boldRed{
			font-weight: bold;
			color:red;
		}
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3>??? Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below
?>
	<p>

	<?php 
			while( $row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	?>
		
        <div class="eventBlock">	
            <div>
				<span class="displayEvent">Event:<?php echo $row['event_name']; ?></span>
				
                <span>Presenter:<?php echo $row['event_presenter']; ?></span>
            </div>
            <div>
            	<span class="displayDescription">Description:<?php echo $row['event_description'];  ?></span>
            </div>
            <div>
            	<span class="displayTime">Time:<?php echo $row['event_time']; ?></span>
            </div>
            <div>
				<span class=
					<?php 
						  $today = strtotime($row['event_date']);
						  
						if( date("m", $today) == date("m") ){
							echo "boldRed" ;
						}
						else if($row['event_date'] > date("Y-m-d")){
							echo "italic";
						}
					?>
				>
				Date:<?php echo $row['event_date'] ; ?></span>
            </div>
        </div>
    </p>

<?php
			}
?>
</div>	
</body>
</html>